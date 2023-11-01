const form = document.querySelector(".form-new-product");
const table = document.querySelector("#table-product tbody");
const errorPrg = document.querySelector("#table-error");
const backBtn = document.querySelector('.form-new-product_btn-back');
const addBtn = document.querySelector('.form-new-product_btn-submit');
// роль
const role = document.querySelector('meta[name="role"]').content;
// поле формы артикула
const articul = document.querySelector('#form-new-product__articul');

// кнопка отмены редактирования
backBtn.onclick = clearForm;
// очистка формы
function clearForm() {
    form.reset();
    backBtn.classList.add('hidden');
    form.setAttribute("data-type", 'add');
    addBtn.value = 'Добавить';
    errorPrg.textContent = '';
}


// события сбрасываются при изменении кода таблицы. переназначение событий
setListeners();
function setListeners() {
    table.querySelectorAll(".product__btn-remove").forEach((btn) => {
        btn.onclick = () => removeRow(btn.closest("tr").id);
    });
    table.querySelectorAll(".product__btn-edit").forEach((btn) => {
        btn.onclick = () => editRowClick(btn.closest("tr"));
    });
}

// Добавление или изменение товара
form.onsubmit = (event) => {
    event.preventDefault();
    let formData = new FormData(event.srcElement);

    if (form.getAttribute("data-type") == "add") {
        addRow(formData);
    } else {
        editRow(formData);
    }
};

// добавление товара
function addRow(formData) {
    let process = (data) => {
        if (data.result == 1) {
            table.innerHTML += `
            <tr class='table-product__tr relative' id="product-${data.id}">
                <td class='p-3 border-e border-black'>
                    <span>${data.articul}</span>
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
            clearForm();
            errorPrg.textContent = "";
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
        "/product",
        process,
        "post",
        errorPrg,
        formData,
        headers
    );
}

// изменение товара
function editRow(formData) {
    // id карточки в БД
    let id = form.getAttribute('data-id');
    id = id.slice(id.indexOf('-')+1);
    formData.set('id', id);

    let process = (data) => {
        if (data.result == 1) {
            form.setAttribute("data-type", 'add');
            // id измененной строки
            let cells = document.querySelector(`#${form.getAttribute("data-id")}`).querySelectorAll("td");
            if (role === 'admin') {
                cells[0].childNodes[1].textContent = form.articul.value;
            }
            cells[1].textContent = form.name.value;
            cells[2].textContent = form.color.value;
            cells[3].textContent = form.size.value;
            clearForm();
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
        "/product/update",
        process,
        "post",
        errorPrg,
        formData,
        headers
    );
}

// удаление товара
function removeRow(id) {
    let data = new URLSearchParams();
    data.set("id", id.slice(id.indexOf("-") + 1));

    let headers = {
        "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
    };

    let process = (data) => {
        if (data.result == 1) {
            table.querySelector(`#${id}`).remove();
        } else {
            errorPrg.textContent = data;
        }
    };

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

// клик редактирования товара
function editRowClick(row) {
    let cells = row.querySelectorAll("td");
    // поле формы артикула
    if (role !== 'admin') {
        form.articul.disabled = true;
    }
    form.articul.value = cells[0].childNodes[1].textContent;
    form.name.value = cells[1].textContent;
    form.color.value = cells[2].textContent;
    form.size.value = cells[3].textContent;
    form.setAttribute('data-id', row.id);
    form.setAttribute("data-type", 'edit');
    backBtn.classList.remove('hidden');
    addBtn.value = 'Сохранить';
}
