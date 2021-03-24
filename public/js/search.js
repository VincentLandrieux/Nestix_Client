
//-----Variable-----
var formSearch;
var inpSearch;
var listSearch;

var xhr = new XMLHttpRequest();

window.onload = () => {
    //-----Variable-----
    inpSearch = document.querySelector('.search-bar');
    formSearch = document.querySelector('.search-form');
    listSearch = document.querySelector('.search-result');

    //-----Event-----
    formSearch.addEventListener('submit', (e) => {
        //cancel the form submit
        e.preventDefault();
    })

    inpSearch.addEventListener('input', () => {
        if(inpSearch.value.length > 0){
            //send search request
            xhr.open('POST', formSearch.action);
            xhr.send(new FormData(formSearch));
        }else{
            //hide search result list
            listSearch.innerHTML = "";
            listSearch.style.display = "none";
        }
    });

    inpSearch.addEventListener('focus', () => {
        if(inpSearch.value.length > 0){
            //display search result list
            listSearch.style.display = "block";
        }
    });
    inpSearch.addEventListener('blur', () => {
        //hide search result list after 0.3s
        setTimeout(() => {
            listSearch.style.display = "none";
        }, 300);
    });

    xhr.addEventListener('readystatechange', () => {
        if (xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200) {
            //result ok
                if(xhr.getResponseHeader("Content-Type") == "application/json"){
                    //get data
                    searchResult = JSON.parse(xhr.response);

                    if(searchResult.length > 0){
                        //reset search result list element
                        listSearch.innerHTML = "";
                        searchResult.forEach((value) => {
                            if(value.type == "livre" || value.type == "film" || value.type == "musique"){
                                urlLink = "media/"+value.id;
                            }else if(value.type == "artiste"){
                                urlLink = "artiste/"+value.id;
                            }else if(value.type == "genre"){
                                urlLink = "medias/genre/"+value.id;
                            }else{
                                urlLink = value.type+"/"+value.type;
                            }
                            //add link element in search result list
                            listSearch.innerHTML +=
                            "<a class='search-result_link' href='"+url+"/"+urlLink+"'>"+ value.nom +" ("+value.type+")"+"</a>";
                        });
                    }else{
                        listSearch.innerHTML =
                        "<a class='search-result_link' href='"+url+"/proposition'>- Aucun Résultat -<br>Proposer un nouveau média</a>";
                    }
                    //display search result list
                    listSearch.style.display = "block";
                }
            }
        }
    });
}
