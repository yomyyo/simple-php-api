<?php require "templates/header.php"; ?>

<h2>Find user based on location</h2>

<form method="post" action="api/get.php">
    <label for="start">Start Date</label>
    <input type="date" id="start" name="start-date">
    <label for="end">End Date</label>
    <input type="date" id="end" name="end-date">
    <label for="ticker">Ticker</label>
    <input type="text" id="ticket" name="ticker">
    <label for="week"><input type="checkbox" id="week" name="week">Group by Week</label>
    <input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
