$(document).ready(function() {
    const newsCreateUrl = 'index.php?controller=admin&action=create';
    const newsUpdateUrl = 'index.php?controller=admin&action=update';
    const newsDeleteUrl = 'index.php?controller=admin&action=delete';
    const newsListUrl = 'index.php?controller=admin&action=list';
    const logoutUrl = 'index.php?controller=login&action=logout';

    loadNews();

    $('#newsForm').submit(function(event) {
        event.preventDefault();

        let formData = {
            id: $('#newsId').val(),
            title: $('#newsTitle').val(),
            content: $('#newsContent').val()
        };

        let url = formData.id ? newsUpdateUrl : newsCreateUrl;

        $.post(url, formData, function(response) {
            if (response.success) {
                $('.success-message')
                    .text(response.message)
                    .show();

                resetForm();
                loadNews();
            } else {
                $('.error-message')
                    .text(response.message)
                    .show();
            }
        }, 'json');
    });

    function loadNews() {
        $.get(newsListUrl, function(response) {
            if (response.success) {
                $('#newsList').empty();
                response.newsList.forEach(news => {
                    $('#newsList').append(`
                        <div class='news-item'>
                            <div class='news-header'>
                                <strong>${news.title}</strong>
                            </div>
                            <p class='news-text'>${news.content}</p>
                            <div class='news-actions'>
                                <button class='edit-btn' data-news='${JSON.stringify(news)}' aria-label='Edit News'>
                                  <img src='/assets/img/pencil.svg' width='24' height='24'>
                                </button>
                                <button class='delete-btn' data-id='${news.id}' aria-label='Delete News'>
                                  <img src='/assets/img/close.svg' width='24' height='24'>
                                </button>
                            </div>
                        </div>
                    `);
                });
            } else {
                $('#newsList').html('');
            }
        }, 'json');
    }

    $(document).on('click', '.edit-btn', function() {
        let news = JSON.parse($(this).attr('data-news'));
        $('#newsId').val(news.id);
        $('#newsTitle').val(news.title);
        $('#newsContent').val(news.content);
        $('#submitBtn').text('Update');
        $('#createUpdate').text('Update News');
        $('#resetFormIcon').show();
    });

    $(document).on('click', '.delete-btn', function() {
        let newsId = $(this).attr('data-id');

        $.post(newsDeleteUrl, { id: newsId }, function(response) {
            if (response.success) {
                $('.success-message')
                    .text(response.message)
                    .show();

                loadNews();
            } else {
                $('.error-message')
                    .text(response.message)
                    .show();
            }
        }, 'json');
    });

    $('#logoutBtn').click(function() {
        $.post(logoutUrl, function(response) {
            if (response.success) {
                location.reload();
            } else {
                $('.error-message')
                    .text(response.message)
                    .show();
            }
        }, 'json');
    });

    $('#resetFormIcon').click(function() {
        resetForm();
    });

    function resetForm() {
        $('#newsId').val('');
        $('#newsTitle').val('');
        $('#newsContent').val('');
        $('#submitBtn').text('Create');
        $('#createUpdate').text('Create News');
        $('#resetFormIcon').hide();
    }
});
