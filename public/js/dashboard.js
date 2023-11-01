const form = document.querySelector('.form-new-product');
const table = document.querySelector('#table-product tbody');
const errorPrg = document.querySelector('#table-error');

setListeners();
function setListeners() {
    table.querySelectorAll('.product__btn-remove').forEach(btn => {btn.onclick = e => removeRow(e.target.closest('tr').id)});
}

// добавление товара
form.onsubmit = (event) => {
    event.preventDefault();
    let formData = new FormData(event.srcElement);

    let process = (data) => {
        if (data.result == 1) {
            table.innerHTML += `
            <tr class='table-product__tr relative' id="product-${data.id}">
                <td class='p-3 border-e border-black'>
                    ${data.articul}
                    <div class='inline float-right'>
                        <button class='product__btn-edit opacity-50' title='Редактировать'>✎</button>
                        <button class='product__btn-remove opacity-50' title='Удалить'>🗑</button>
                    </div>
                </td>
                <td class='p-3 text-center border-e border-black'>${data.name}</td>
                <td class='p-3 text-end border-e border-black'>${data.color}</td>
                <td class='p-3 text-end'>${data.size}</td>
            </tr>
            `;
            setListeners();
            errorPrg.textContent = '';
        } else {
            errorPrg.textContent = data.description;
        }
    };

    let headers = {
        "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
    };

    // запрос на сервер
    ServerRequest.execute(
        '/product',
        process,
        "post",
        this.msgElement,
        formData,
        headers
    );
}

// удаление товара
function removeRow(id) {
    let data = new URLSearchParams();
    data.set('id', id.slice(id.indexOf('-')+1));

    let headers = {
        "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
    };

    let process = (data) => {
        if (data.result == 1) {
            table.querySelector(`#${id}`).remove();
        }else {
            errorPrg.textContent = data;
        }
    }

    // запрос на сервер
    ServerRequest.execute(
        `/product/remove`,
        process,
        "post",
        errorPrg,
        data,
        headers
    );
}