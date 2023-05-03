import depoLocations from '../assets/data/depo-locations.json';

jQuery(document).ready(function ($) {
  $('.variations_form').on('woocommerce_variation_select_change', function () {
    $('#single-product-price-placeholder').show(0);
  });

  $('.single_variation_wrap').on('show_variation', function (event, variation) {
    $('#single-product-price-placeholder').hide(0);
  });
});

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

const singleProductAutocompleteInput = document.getElementById('single-product-autocomplete-input');
const singleProductAutocompleteList = document.getElementById('single-product-autocomplete-list');
const singleProductAutocompleteWrap = document.getElementById('single-product-autocomplete');

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

singleProductAutocompleteInput.addEventListener('input', (e) => {
  const filteredData = filterData(depoLocations, singleProductAutocompleteInput.value);
  console.log('filteredData', filteredData);
  loadData(filteredData, singleProductAutocompleteList);
  e.target.classList.add('active');
  console.log(e.target);
});

singleProductAutocompleteWrap.addEventListener('blur', (e) => {
  console.log('blur');
  singleProductAutocompleteList.style.display = 'none';
  singleProductAutocompleteInput.classList.remove('active');
});

singleProductAutocompleteInput.addEventListener('focus', (e) => {
  console.log('focus');
  singleProductAutocompleteList.style.display = 'block';
  //e.target.classList.add('active');
});
