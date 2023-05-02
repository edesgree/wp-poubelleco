import depoLocations from '../assets/data/depo-locations.json';
/*
jQuery(document).ready(function($){
    

    var singleProductAutocompleteList ="";
    locations.forEach(function(location){
        singleProductAutocompleteList +="<li>";
        singleProductAutocompleteList += location["Suburb"];
        singleProductAutocompleteList +="</li>";
    })
    $('#single-product-autocomplete-list').append(singleProductAutocompleteList)
})*/
const singleProductAutocompleteInput = document.getElementById('single-product-autocomplete-input');
const singleProductAutocompleteList = document.getElementById('single-product-autocomplete-list');

let locations = [];

function fetchLocations() {
  locations = depoLocations.map((item) => item.Suburb);
  locations.sort();
  //loadData(locations, singleProductAutocompleteList);
  console.log(locations);
}
function loadData(data, element) {
  let currentUrl = window.location.pathname;
  console.log('data used:', data);
  if (data) {
    element.innerHTML = '';
    data.forEach((item) => {
      let distance = '';
      if (item['Distance'] > 0 && item['Distance'] <= 25) {
        distance = '0-25km';
      }
      if (item['Distance'] > 25 && item['Distance'] <= 50) {
        distance = '25-50km';
      }
      if (item['Distance'] > 50 && item['Distance'] <= 75) {
        distance = '50-75km';
      }
      if (item['Distance'] > 75 && item['Distance'] <= 100) {
        distance = '75-100km';
      }
      if (item['Distance'] > 100) {
        distance = '100km+';
      }
      const li = document.createElement('li');
      let liContent = '';
      liContent += `
      <a href="${currentUrl}?attribute_depo=${item['Depo']}&attribute_distance=${distance}&toto=${item['Distance']}">
      ${item['Suburb']},${item['Postcode']}
      </a>`;

      li.innerHTML = liContent;
      element.appendChild(li);
    });
  }
}
function filterData(data, searchText) {
  let res = data.filter((item) => item.toLowerCase().includes(searchText));
  console.log('res', res);
  return res;
}
fetchLocations();

singleProductAutocompleteInput.addEventListener('input', () => {
  console.log('locations', locations);
  const filteredData = filterData(locations, singleProductAutocompleteInput.value);
  console.log('filteredData', filteredData);
  loadData(filteredData, singleProductAutocompleteList);
});

/*
function autocomplete({target} listElement, data) {
    inputElement.addEventListener('input', async () => {
      const inputValue = inputElement.value.toLowerCase();
      
      const filteredData = data.filter(item => item['Suburb'].toLowerCase().startsWith(inputValue));
      displayAutocompleteList(listElement, filteredData);
      console.log(filteredData)
    });
    listElement.addEventListener('click', event => {
        if (event.target.tagName === 'LI') {
          inputElement.value = event.target.textContent;
          listElement.innerHTML = '';
        }
      });
  }
  
  function displayAutocompleteList(listElement, data) {
    let currentUrl = window.location.pathname;

    listElement.innerHTML = '';
    data.forEach(item => {
        let distance = '';
      if (item['Distance'] > 0 && item['Distance'] <= 25) {
        distance = '0-25km'
      }
      if (item['Distance'] > 25 && item['Distance'] <= 50) {
        distance = '25-50km'
      }
      if (item['Distance'] > 50 && item['Distance'] <= 75) {
        distance = '50-75km'
      }
      if (item['Distance'] > 75 && item['Distance'] <= 100) {
        distance = '75-100km'
      }
      if (item['Distance'] > 100) {
        distance = '100km+'
      }
      const li = document.createElement('li');
      let liContent='';
      liContent += `
      <a href="${currentUrl}?attribute_depo=${item['Depo']}&attribute_distance=${distance}&toto=${item['Distance']}">
      ${item['Suburb']},${item['Postcode']}
      </a>`;

      li.innerHTML = liContent;
      listElement.appendChild(li);
    });
  }
  
  singleProductAutocompleteInput.addEventListener('input',e =>{
    autocomplete(this, autocompleteList, locations);
  }) 

  */
