$(document).ready(function() {
    var apiKey = '0c47a43c7636782927e51c098c9474fa';
  
    // Realiza una solicitud GET para obtener las películas populares
    $.ajax({
      url: 'https://api.themoviedb.org/3/movie/popular',
      data: {
        api_key: apiKey
      },
      success: function(data) {
        var movies = data.results;
  
        // Recorre la lista de películas y muestra cada una con un enlace
        movies.forEach(function(movie) {
          var movieElement = $('<div class="movie"></div>');
          var titleElement = $('<h2><a href="https://www.themoviedb.org/movie/' + movie.id + '">' + movie.title + '</a></h2>');
          var posterElement = $('<img src="https://image.tmdb.org/t/p/w200' + movie.poster_path + '">');
  
          movieElement.append(titleElement);
          movieElement.append(posterElement);
          $('#movies-list').append(movieElement);
        });
      }
    });
  });