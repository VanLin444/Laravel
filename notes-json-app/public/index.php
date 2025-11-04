<?php
// Простая заметочная система (JSON storage) — single file app.
// Run: php -S localhost:8000 -t public

declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

// Путь к JSON-файлу (один уровень вверх в папку data)
$dataDir = __DIR__ . '/../data';
$dataFile = $dataDir . '/notes.json';

// Обеспечим существование папки data
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// Инициализация файла, если его нет
if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// === Функции работы с JSON файлом ===
function readNotes(string $dataFile): array
{
    $json = file_get_contents($dataFile);
    $arr = json_decode($json, true);
    if (!is_array($arr)) return [];
    return $arr;
}

function writeNotes(string $dataFile, array $notes): bool
{
    // Простая блокировка для предотвращения гонок
    $tmp = $dataFile . '.tmp';
    $fh = fopen($tmp, 'c');
    if ($fh === false) return false;
    if (!flock($fh, LOCK_EX)) {
        fclose($fh);
        return false;
    }
    $ok = fwrite($fh, json_encode($notes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    fflush($fh);
    flock($fh, LOCK_UN);
    fclose($fh);
    // атомарная замена
    return rename($tmp, $dataFile);
}

function generateId(array $notes): int
{
    $ids = array_column($notes, 'id');
    if (empty($ids)) return 1;
    return max($ids) + 1;
}

// Простая валидация поля title
function validateNoteInput(array $data): array
{
    $errors = [];
    $title = trim((string)($data['title'] ?? ''));
    if ($title === '') $errors['title'] = 'Title required';
    elseif (mb_strlen($title) > 255) $errors['title'] = 'Title too long';
    return $errors;
}

// === Роутинг (минимальный) ===
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Поддерживаем два пути:
// GET  /          -> возвращает фронтенд (HTML)
// GET  /api/notes -> список заметок
// POST /api/notes -> создать заметку (JSON body)
// GET  /api/notes/{id} -> получить заметку
// PUT  /api/notes/{id} -> обновить заметку
// DELETE /api/notes/{id} -> удалить заметку

// Отдать фронтенд если путь корневой или /index.php
if ($method === 'GET' && ($path === '/' || preg_match('#/index\.php$#', $path))) {
    // Отправляем HTML (не JSON) — простая страница, поэтому поменяем header
    header('Content-Type: text/html; charset=utf-8');
    echo <<<HTML
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Notes JSON App</title>
<style>
body{font-family:Arial,Helvetica,sans-serif;max-width:900px;margin:20px auto;padding:0 10px}
h1{font-size:24px}
.note{border:1px solid #ddd;padding:10px;margin:8px 0;border-radius:6px}
.form-row{margin:8px 0}
button{cursor:pointer}
</style>
</head>
<body>
<h1>Notes (JSON storage)</h1>
<div>
    <div class="form-row">
        <input id="title" placeholder="Title" style="width:70%" />
        <button onclick="create()">Add</button>
    </div>
    <div id="list"></div>
</div>
<script>
const listEl = document.getElementById('list');
async function load(){
    const res = await fetch('/api/notes');
    const data = await res.json();
    render(data);
}
function render(notes){
    listEl.innerHTML = '';
    if(notes.length===0){ listEl.innerHTML = '<p>No notes</p>'; return; }
    notes.forEach(n=>{
        const div=document.createElement('div');
        div.className='note';
        div.innerHTML = '<strong>#'+n.id+'</strong> <em>'+escapeHtml(n.title)+'</em> <button onclick="del('+n.id+')">Del</button> <button onclick="edit('+n.id+')">Edit</button><div style="color:#666;margin-top:6px">'+(n.created_at||'')+'</div>';
        listEl.appendChild(div);
    });
}
function escapeHtml(s){ return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
async function create(){
    const title = document.getElementById('title').value;
    const res = await fetch('/api/notes', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({title})
    });
    const data = await res.json();
    if(data.error) alert(JSON.stringify(data.error));
    else { document.getElementById('title').value=''; load(); }
}
async function del(id){
    if(!confirm('Delete note #'+id+'?')) return;
    await fetch('/api/notes/'+id, {method:'DELETE'});
    load();
}
async function edit(id){
    const newTitle = prompt('New title for #' + id);
    if(newTitle === null) return;
    await fetch('/api/notes/'+id, {
        method:'PUT',
        headers:{'Content-Type':'application/json'},
        body: JSON.stringify({title:newTitle})
    });
    load();
}
load();
</script>
</body>
</html>
HTML;
    exit;
}

// API routes
if (strpos($path, '/api/notes') === 0) {
    // Удалим лишние префиксы
    $parts = explode('/', trim($path, '/'));
    // parts: ['api','notes', '{id?}']
    $id = isset($parts[2]) && ctype_digit($parts[2]) ? (int)$parts[2] : null;

    // Read current notes
    $notes = readNotes($dataFile);

    if ($method === 'GET' && $id === null) {
        // Список (по убыванию id)
        usort($notes, fn($a, $b) => $b['id'] <=> $a['id']);
        echo json_encode($notes, JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ($method === 'GET' && $id !== null) {
        foreach ($notes as $n) {
            if ($n['id'] === $id) {
                echo json_encode($n, JSON_UNESCAPED_UNICODE);
                exit;
            }
        }
        http_response_code(404);
        echo json_encode(['error' => 'Not found']);
        exit;
    }

    // Получаем тело запроса (JSON)
    $body = json_decode(file_get_contents('php://input'), true) ?? [];

    if ($method === 'POST' && $id === null) {
        $errors = validateNoteInput($body);
        if (!empty($errors)) {
            http_response_code(422);
            echo json_encode(['error' => $errors]);
            exit;
        }
        $new = [
            'id' => generateId($notes),
            'title' => trim((string)$body['title']),
            'created_at' => date('c')
        ];
        $notes[] = $new;
        if (!writeNotes($dataFile, $notes)) {
            http_response_code(500);
            echo json_encode(['error' => 'Could not save note']);
            exit;
        }
        http_response_code(201);
        echo json_encode($new, JSON_UNESCAPED_UNICODE);
        exit;
    }

    if (($method === 'PUT' || $method === 'PATCH') && $id !== null) {
        $found = false;
        foreach ($notes as &$n) {
            if ($n['id'] === $id) {
                $found = true;
                $errors = validateNoteInput($body);
                if (!empty($errors)) {
                    http_response_code(422);
                    echo json_encode(['error' => $errors]);
                    exit;
                }
                $n['title'] = trim((string)$body['title']);
                $n['updated_at'] = date('c');
                break;
            }
        }
        if (!$found) {
            http_response_code(404);
            echo json_encode(['error' => 'Not found']);
            exit;
        }
        if (!writeNotes($dataFile, $notes)) {
            http_response_code(500);
            echo json_encode(['error' => 'Could not save note']);
            exit;
        }
        echo json_encode(['ok' => true]);
        exit;
    }

    if ($method === 'DELETE' && $id !== null) {
        $found = false;
        foreach ($notes as $idx => $n) {
            if ($n['id'] === $id) {
                $found = true;
                array_splice($notes, $idx, 1);
                break;
            }
        }
        if (!$found) {
            http_response_code(404);
            echo json_encode(['error' => 'Not found']);
            exit;
        }
        if (!writeNotes($dataFile, $notes)) {
            http_response_code(500);
            echo json_encode(['error' => 'Could not delete note']);
            exit;
        }
        echo json_encode(['ok' => true]);
        exit;
    }

    // Если метод не поддерживается
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Любые другие пути — 404
http_response_code(404);
echo json_encode(['error' => 'Not found']);
exit;
