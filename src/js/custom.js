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
const headerAutocompleteWrap = document.getElementById('header-search-autocomplete');
const headerAutocompleteInput = document.getElementById('header-autocomplete-input');
const headerAutocompleteList = document.getElementById('header-autocomplete-list');
const headerAutocompleteCloseBtn = document.getElementById('search-input-reset');
const headerQuickSelectBinsWrap = document.getElementById('quick-select-bins');
const HeaderQuickSelectBinsSuburbSelectedTitle = document.getElementById('quick-select-suburb-selected');
const HeaderQuickSelectBinsProduct = document.querySelectorAll('[data-quick-select-product]');
let locations = [];
// get location param in url and fill in the input value
if (urlParams.has('location') && singleProductAutocompleteInput) {
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

function displaySearchResultHeader(data, element) {
  let currentUrl = window.location.pathname;
  if (data) {
    element.innerHTML = '';
    data.forEach((item) => {
      let distance = getDistanceLabel(item['Distance']);
      const li = document.createElement('li');
      let liContent = '';
      liContent += `
      <a href="#" data-search-result
      data-distance="${distance}" 
      data-depo="${item['Depo']}"
      data-suburb="${item['Suburb']}"
      >
      ${item['Suburb']}, ${item['Postcode']},  ${distance}, ${item['Depo']}, 
      </a>`;
      li.innerHTML = liContent;
      element.appendChild(li);
    });
  }
  function headerShortcodeProducts(item) {
    console.log('headerShortcodeProducts', item);
    resetHeaderAutocomplete();
    let depo = item.dataset.depo;
    let distance = item.dataset.distance;
    let suburb = item.dataset.suburb;
    console.log('depo', depo);
    console.log('distance', distance);

    headerAutocompleteInput.value = suburb;
    headerQuickSelectBinsWrap.classList.add('active');

    //hide autocomplete
    //show results quick bins
    HeaderQuickSelectBinsProduct.forEach((el) => {
      let productid = el.dataset.productid;

      console.log(el);
      //show good price
      document.querySelectorAll('.depo-price').forEach((el) => {
        console.log(el);
        if (el.dataset.depo === depo && el.dataset.distance === distance) {
          el.classList.add('active');
        } else {
          el.classList.remove('active');
        }

        var productid = jQuery(this).data('productid');
      });

      //edit button link
      console.log(el.querySelector('[data-add-to-cart]').getAttribute('href'));
      el.querySelector('[data-add-to-cart]').setAttribute(
        'href',
        `/?add-to-cart=${productid}&attribute_depo=${depo}&attribute_distance=${distance}`
      );
    });
  }

  // Add event listener to each element with the data-toto attribute
  document.querySelectorAll('[data-search-result]').forEach((el) => {
    el.addEventListener('click', function (e) {
      headerShortcodeProducts(e.target);
    });
  });
}
function displaySearchResultSingleProduct(data, element) {
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

// autocomplete header:

headerAutocompleteInput.addEventListener('input', (e) => {
  const filteredData = filterData(depoLocations, headerAutocompleteInput.value);
  if (headerAutocompleteInput.value != '') {
    displaySearchResultHeader(filteredData, headerAutocompleteList);
    headerAutocompleteList.style.display = 'block';
  } else {
    headerAutocompleteList.style.display = 'none';
    headerQuickSelectBinsWrap.classList.remove('active');
  }

  e.target.classList.add('active');
});
function resetHeaderAutocomplete() {
  console.log('resetHeaderAutocomplete');
  headerAutocompleteInput.value = '';
  headerAutocompleteList.style.display = 'none';
  headerAutocompleteInput.classList.remove('active');
  headerQuickSelectBinsWrap.classList.remove('active');
}

headerAutocompleteInput.addEventListener('focus', (e) => {
  headerAutocompleteCloseBtn.classList.add('active');
});
headerAutocompleteCloseBtn.addEventListener('click', (e) => {
  resetHeaderAutocomplete();
  e.currentTarget.classList.remove('active');
});
// autocomplete product page:
if (singleProductAutocompleteInput) {
  singleProductAutocompleteInput.addEventListener('input', (e) => {
    const filteredData = filterData(depoLocations, singleProductAutocompleteInput.value);
    displaySearchResultSingleProduct(filteredData, singleProductAutocompleteList);
    e.target.classList.add('active');
  });

  singleProductAutocompleteWrap.addEventListener('blur', (e) => {
    singleProductAutocompleteList.style.display = 'none';
    singleProductAutocompleteInput.classList.remove('active');
  });

  singleProductAutocompleteInput.addEventListener('focus', (e) => {
    singleProductAutocompleteList.style.display = 'block';
  });
}
