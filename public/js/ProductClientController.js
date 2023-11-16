/** Фронт-контроллер таблицы 
  *
  GET|HEAD        product ...................product.index › ProductController@index
  *
  POST            product ..................product.store › ProductController@store
  *
  GET|HEAD        product/create ...........product.create › ProductController@create
  *
  GET|HEAD        product/{product} ........product.show › ProductController@show
  *
  PUT|PATCH       product/{product} ........product.update › ProductController@update
  *
  DELETE          product/{product} ........product.destroy › ProductController@destroy
  *
  GET|HEAD        product/{product}/edit ...product.edit › ProductController@edit
*/
class ProductClientController {
    constructor(URL, table, msgElement, addForm = null, editForm = null) {
        this.URL = URL;
        this.table = table;
        this.msgElement = msgElement;
        this.addForm = addForm;
        this.editForm = editForm;
        this.csrfToken = document.querySelector('meta[name="csrf-token"]');

        // таблица
        if (this.table) {
            this.table
                .querySelectorAll(`.${this.table.id}__tr`)
                .forEach((row) => (row.onclick = (e) => this.clickRow(e)));

            this.table
                .querySelectorAll(".product__btn-remove")
                .forEach((btn) => {
                    btn.onclick = (e) => this.remove(e.target.closest("tr"));
                });
        }

        // форма добавления нового товара
        if (this.addForm) {
            this.addForm.onsubmit = event => this.add(event);
            this.addFormId = addForm.id;
        }
        // форма изменения товара
        if (this.editForm) {
            this.editForm.onsubmit = event => this.update(event);
            this.editFormId = editForm.id;
        }
    }

    // добавить новый товар в БД
    add(event) {
        event.preventDefault();
        // действия после успешного добавления данных в БД
        let process = (data) => {
            if (data.result == 1) {
                this.msgElement.textContent =`${data.row.articul}: ${data.row.name} добавлен`;
            } else {
                this.msgElement.textContent = data.description;
            }
        };
        let formData = new FormData(this.addForm);
        formData.set("data", this.getAttributesFromForm(this.addForm));
        // заголовки
        let headers = {
            "X-CSRF-TOKEN": this.csrfToken.getAttribute("content"),
        };
        // запрос на сервер
        ServerRequest.execute(
            this.URL,
            process,
            "post",
            this.msgElement,
            formData,
            headers
        );
    }

    // обновить товар в БД
    update(event) {
        event.preventDefault();

        let data = {};
        data.id = this.editForm.getAttribute('data-id');
        // артикул
        if (this.editForm.articul) {
            data.articul = this.editForm.articul
        } else {
            data.articul = document.querySelector('#form-edit-product').textContent;
        }
        // имя
        data.name = this.editForm.name.value;
        // статус
        data.status = this.editForm.status.value;
        // аттрибуты
        data.data = this.getAttributesFromForm(this.editForm);
        // обработка результата запроса
        let process = (data) => {
            if (data.result == 1) {
                this.msgElement.textContent = 'данные обновлены';
            } else {
                this.msgElement.textContent = data.description;
            }
        };
        // заголовки
        let headers = {
            "X-CSRF-TOKEN": this.csrfToken.getAttribute("content"),
            'Content-Type': 'application/json'
        };
        // запрос на сервер
        ServerRequest.execute(
            `/product/${data.id}`,
            process,
            "patch",
            this.msgElement,
            JSON.stringify(data),
            headers
        );
    }

    // удалить товар в БД
    remove(row) {
        let id = row.id;
        id = id.slice(id.indexOf("-") + 1);
        // заголовки
        let headers = {
            "X-CSRF-TOKEN": this.csrfToken.getAttribute("content"),
        };
        // действия после успешного удаления данных в БД
        let process = (data) => {
            if (data.result == 1) {
                // удаление данных из клиента
                row.remove();
                this.msgElement.textContent = "";
            } else {
                this.msgElement.textContent = data;
            }
        };

        // запрос на сервер
        ServerRequest.execute(
            `${this.URL}/${id}`,
            process,
            "delete",
            this.msgElement,
            null,
            headers
        );
    }

    getAttributesFromForm(form) {
        // атрибуты
        let data = new Map();
        let attributesElements = document.querySelectorAll(
            `.${form.id}__attribute`
        );
        if (attributesElements.length > 0) {
            attributesElements.forEach((element) => {
                let name = element.querySelector(
                    `.${form.id}__attr-name`
                ).value;
                let value = element.querySelector(
                    `.${form.id}__attr-value`
                ).value;
                if (name !== "" && value !== "") {
                    data.set(name, value);
                }
            });
        }
        return JSON.stringify(Object.fromEntries(data));        
    }
}
