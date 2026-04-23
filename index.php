<?php
$notesFile = __DIR__ . '/notes.json';

if (!file_exists($notesFile)) {
    file_put_contents($notesFile, json_encode([]));
}

$notes = json_decode(file_get_contents($notesFile), true);
if (!is_array($notes)) {
    $notes = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini PHP Notes App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Mini PHP Notes App</h1>

        <form action="save.php" method="post" class="note-form">
            <textarea name="note" placeholder="Write a note..." required></textarea>
            <button type="submit">Save Note</button>
        </form>

        <h2>Saved Notes</h2>

        <?php if (empty($notes)): ?>
            <p class="empty">No notes yet.</p>
        <?php else: ?>
            <ul class="notes">
                <?php foreach (array_reverse($notes) as $item): ?>
                    <li>
                        <div class="note-text"><?php echo htmlspecialchars($item['text']); ?></div>
                        <div class="note-date"><?php echo htmlspecialchars($item['created_at']); ?></div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>
