import depoLocations from '../assets/data/depo-locations.json';

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

const singleProductAutocompleteInput = document.getElementById('single-product-autocomplete-input');
const singleProductAutocompleteList = document.getElementById('single-product-autocomplete-list');

let locations = [];
// get location param in url and fill in the input value
if (urlParams.has('location')) {
  singleProductAutocompleteInput.value = urlParams.get('location');
}
function fetchLocations() {
  depoLocations.sort((a, b) => a.Suburb.localeCompare(b.Suburb));
  locations = depoLocations.map((item) => item.Suburb);
}
function getDistanceLabel(distance) {
  let label = '';
  if (distance > 0 && distance <= 25) {
    label = '0-25km';
  }
  if (distance > 25 && distance <= 50) {
    label = '25-50km';
  }
  if (distance > 50 && distance <= 75) {
    label = '50-75km';
  }
  if (distance > 75 && distance <= 100) {
    label = '75-100km';
  }
  if (distance > 100) {
    label = '100km+';
  }

  return label;
}
function loadData(data, element) {
  let currentUrl = window.location.pathname;
  if (data) {
    element.innerHTML = '';
    data.forEach((item) => {
      let distance = getDistanceLabel(item['Distance']);
      const li = document.createElement('li');
      let liContent = '';
      liContent += `
      <a href="${currentUrl}?attribute_depo=${item['Depo']}&attribute_distance=${distance}&location=${item['Suburb']}">
      ${item['Suburb']}, ${item['Postcode']}
      </a>`;
      li.innerHTML = liContent;
      element.appendChild(li);
    });
  }
}
function filterData(data, searchText) {
  let res = data.filter((item) => item.Suburb.toLowerCase().includes(searchText));
  return res;
}
fetchLocations();

singleProductAutocompleteInput.addEventListener('input', () => {
  const filteredData = filterData(depoLocations, singleProductAutocompleteInput.value);
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
