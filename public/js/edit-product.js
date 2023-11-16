/*
 GET|HEAD        product ...................product.index › ProductController@index
  POST            product ..................product.store › ProductController@store
  GET|HEAD        product/create ...........product.create › ProductController@create
  GET|HEAD        product/{product} ........product.show › ProductController@show
  PUT|PATCH       product/{product} ........product.update › ProductController@update
  DELETE          product/{product} ........product.destroy › ProductController@destroy
  GET|HEAD        product/{product}/edit ...product.edit › ProductController@edit
*/


const formClass = 'form-edit-product';
const tableError = document.querySelector("#table-error");
const form = document.querySelector(".form-edit-product");
const id = form.getAttribute('data-id');
const csrfToken = document.querySelector('meta[name="csrf-token"]');
let headers = {
    "X-CSRF-TOKEN": csrfToken.getAttribute("content"),
    'Content-Type': 'application/json'
};

form.addEventListener('submit', function(event) {
    event.preventDefault();
    let data = {};
    // артикул
    if (form.articul) {
        data.articul = form.articul
    } else {
        data.articul = document.querySelector('#form-edit-product').textContent;
    }
    // имя
    data.name = form.name.value;
    // статус
    data.status = form.status.value;
    // атрибуты
    let attrMap = new Map();
    let attributesElements = document.querySelectorAll(
        ".form-edit-product__attribute"
    );
    if (attributesElements.length > 0) {
        attributesElements.forEach((element) => {
            let name = element.querySelector(
                ".form-edit-product__attr-name"
            ).value;
            let value = element.querySelector(
                ".form-edit-product__attr-value"
            ).value;
            if (name !== "" && value !== "") {
                attrMap.set(name, value);
            }
        });
    }
    attr = JSON.stringify(Object.fromEntries(attrMap));
    data.data = attr;
    
    fetch(`/product/${id}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-TOKEN": csrfToken.getAttribute("content"),
        },
        body: JSON.stringify(data)
    }).then(r => r.text()).then(data => {
        console.log(data);
    });
});