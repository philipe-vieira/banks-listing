<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

  <title>Lista de Bancos</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      width: 100vw;
      margin: 0;
    }

    .container {
      height: 92vh;
      max-height: 900px;
      width: 100%;
      max-width: 800px;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #333;
    }

    input[type="text"] {
      width: calc(100% - 20px);
      padding: 10px;
      font-size: 16px;
      margin-bottom: 20px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    ul {
      list-style-type: none;
      padding: 0;

      max-height: calc(100% - 180px);
      overflow-y: scroll;
    }

    li {
      padding: 10px;
      margin-bottom: 8px;
      background-color: #f9f9f9;
      border-radius: 4px;
      transition: background-color 0.3s;
    }

    li:hover {
      background-color: #eaeaea;
    }

    .no-results {
      text-align: center;
      color: #888;
    }


    .pagination {
        display: flex;
        justify-content: center;
        gap: 3px;
    }
    .pagination button {
        padding: 6px 8px;
        cursor: pointer;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f1f1f1;
    }
    .pagination button.active {
        background-color: #007bff;
        color: white;
    }
  </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Bancos</h2>
        <input type="text" id="searchInput" placeholder="Search items..." onkeyup="filterList()">
        <p id="loading">Loading...</p>
        <ul id="list" style="display: none;">
            <li>Apple</li>
            <li>Banana</li>
            <li>Orange</li>
            <li>Grapes</li>
            <li>Watermelon</li>
        </ul>
        <p id="noResults" class="no-results" style="display: none;">No results found.</p>
        <div id="pagination"></div>
    </div>

  <script>
    $(document).ready(function() {
        loadList();
    });

    function loadList(page = 1){
        $('ul#list').hide();
        $('p#loading').show();
        $('p#noResults').hide();

        $.get(`{{ route('bancos.index') }}?page=${page}`, function(data, status, xhr) {
            $('p#loading').hide();
            if (xhr.status != 200) {
                $('ul#list').hide();
                $('p#noResults').show();
                return;
            }

            $('ul#list').empty();
            data.data.forEach( function (banco) {
                text = banco.codigo + ' - ' + banco.nome
                $('#list').append(`<li><a href="{{ route('bancos.show', '') }}/${banco.codigo}">` + text + `</a></li>`);
            });

            $('ul#list').show();

            generatePagination(data.links)
        });
    }

    function generatePagination(links) {
        const $paginationDiv = $('#pagination');
        $paginationDiv.empty();

        const $paginationContainer = $('<div></div>', { class: 'pagination' });

        links.forEach(link => {
            const $button = $('<button></button>').html(link.label);

            if (link.active) {
                $button.addClass('active');
            }

            if (link.url) {
                const pageNumber = extractPageNumberFromUrl(link.url);
                $button.on('click', () => {
                    console.log(`Loading page: ${pageNumber}`);
                    loadList(pageNumber);
                });
            } else {
                $button.prop('disabled', true);
            }
            $paginationContainer.append($button);
        });

        $paginationDiv.append($paginationContainer);
    }

    function extractPageNumberFromUrl(url) {
        const regex = /[?&]page=(\d+)/;
        const match = url.match(regex);
        return match ? match[1] : null;
    }

    function filterList() {
      const input = document.getElementById('searchInput').value.toLowerCase();
      const listItems = document.querySelectorAll('#list li');
      let resultsFound = false;

      listItems.forEach(item => {
        const text = item.textContent.toLowerCase();
        if (text.includes(input)) {
          item.style.display = 'block';
          resultsFound = true;
        } else {
          item.style.display = 'none';
        }
      });

      const noResultsMessage = document.getElementById('noResults');
      if (resultsFound) {
        noResultsMessage.style.display = 'none';
      } else {
        noResultsMessage.style.display = 'block';
      }
    }
  </script>
</body>
</html>
