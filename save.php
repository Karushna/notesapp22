<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$note = trim($_POST['note'] ?? '');
$notesFile = __DIR__ . '/notes.json';

if ($note === '') {
    header('Location: index.php');
    exit;
}

if (!file_exists($notesFile)) {
    file_put_contents($notesFile, json_encode([]));
}

$notes = json_decode(file_get_contents($notesFile), true);
if (!is_array($notes)) {
    $notes = [];
}

$notes[] = [
    'text' => $note,
    'created_at' => date('Y-m-d H:i:s')
];

file_put_contents($notesFile, json_encode($notes, JSON_PRETTY_PRINT));

header('Location: index.php');
exit;
