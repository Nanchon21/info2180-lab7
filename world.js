document.addEventListener('DOMContentLoaded', (event) => {
    const input = document.getElementById('country');
    const SearchField = document.getElementById('lookup');
    const citiesBtn = document.getElementById('lookup-cities')
    
    if (SearchField && input) {
        SearchField.onclick = () => { handleSearch(input, false); }
    }
    
    if (citiesBtn && input) {
        citiesBtn.onclick = () => {
            handleSearch(input, true)
        }
    }
});

function handleSearch(inputVal, city) {
    const searchValue = inputVal.value.trim();
    searchValue.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/"/g, '&quot;');     
    getCountryResult(searchValue, city);   
 }

function getCountryResult(searchValue, city) {
    let httpRequest = new XMLHttpRequest();
    let params = city === true? ("country=" + searchValue + "&context=cities") : ("country=" + searchValue);
    httpRequest.open("GET", "world.php?"+ params);

    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) { 
                console.log(httpRequest.responseText);       
                displaySearchResult(httpRequest.responseText);            
            } else {
                console.log(httpRequest.responseText);  
                displaySearchResult("There was a problem conducting the search. Please try again later."); 
            }
        }
    }
    httpRequest.send();
}
function displaySearchResult(stringValue) {
    const resultDiv = document.getElementById("result");
    resultDiv.innerHTML = "";
    const div = document.createElement('div');
    div.setAttribute("class", "result-content");
    div.innerHTML = stringValue;
    resultDiv.append(div);
}