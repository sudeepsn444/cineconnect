let movieNameRef = document.getElementById("movie-name");
let searchBtn = document.getElementById("search-btn");
let result = document.getElementById("result");

//function to fetch data from api

let getMovie = () => {
    let movieName = movieNameRef.value;
    let url = `http://www.omdbapi.com/?t=${movieName}&apikey=${key}`;
    //if input field is empty

    if (movieName.length <= 0) {
        result.innerHTML = `<p class="card-description">please enter a movie name....</p>`;
      }

    //if input isn't empty
    else {
        fetch(url).then((resp) => resp.json()).then((data) => {
            //if movie exist in database
            if (data.Response == "True") {
                result.innerHTML = `
                    <div class="info">
                        <img src=${data.Poster} class="poster">
                        
                        <div>
                        <br>
                            <h2 class="text-primary">${data.Title}</h2>
                            <div class="rating">
                                <i class="bi-star-fill text-warning"></i>
                                <span>${data.imdbRating}</span>
                            </div>
                            <div class="details">
                                <span>${data.Rated}</span>&nbsp;
                                <span>${data.Year}</span>&nbsp;
                                <span>${data.Runtime}</span>
                            </div>
                            <div class="genre d-flex justify-content-space-around">
                                <span class="bg-primary text-white shadow-sm" style="font-size: 0.75em;padding: 0.4em 1.6em;border-radius: 0.4em;font-weight: 300;"> ${data.Genre.split(",").join("</span>&nbsp;<span class='bg-primary text-white shadow-sm' style='border: 1px solid #a0a0a0;font-size: 0.75em;padding: 0.4em 1.6em;border-radius: 0.4em;font-weight: 300;'>")} </span>
                            </div><br>
                        </div>
                    </div>
                    <h3 class="text-primary">Plot:</h3>
                    <p class="text-muted">${data.Plot}</p><br>
                    <h3 class="text-primary">Cast:</h3>
                    <p class="text-muted">${data.Actors}</p>
                `;
            }

            //if movie doesn't exist in database
            else {
                result.innerHTML = `<h3 class="msg">${data.Error}</h3>`;
            }
        })
            //if error occurs
            .catch(() => {
                result.innerHTML = `<h3 class="msg">Error Occured</h3>`;
            });
    }
};

searchBtn.addEventListener("click", getMovie);
window.addEventListener("load", getMovie);