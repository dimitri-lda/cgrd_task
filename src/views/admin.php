<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/news.js"></script>
</head>
<body>

<div class="container">
    <img src="/assets/img/logo.svg" alt="cgrd" width="70" height="70">
    <p class="success-message"></p>
    <main class="main-content">
        <div id="newsListSection">
            <h3>All News</h3>
            <div id="newsList"></div>
        </div>
        <div class="form-container">
            <div class="header-wrapper">
                <h3 id="createUpdate">Create News</h3>
                <img id="resetFormIcon" src="/assets/img/close.svg" alt="Reset Form" width="24" height="24">
            </div>
            <form id="newsForm">
                <input type="hidden" name="id" id="newsId" value="">
                <input type="text" name="title" id="newsTitle" placeholder="Title" required>
                <textarea name="content" id="newsContent" placeholder="Description" required></textarea>
                <button type="submit" id="submitBtn">Create</button>
            </form>
            <button id="logoutBtn">Logout</button>
        </div>
    </main>
</div>

</body>
</html>
