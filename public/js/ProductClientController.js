/** Фронт-контроллер таблицы */
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
            this.editForm.onsubmit = (event) => this.add(editForm, event);
            this.editFormId = editForm.id;
        }
    }

    // добавить запись в БД
    add(event) {
        event.preventDefault();

        // атрибуты
        let data = new Map();
        let attributesElements = document.querySelectorAll(
            `.${this.addFormId}__attribute`
        );
        if (attributesElements.length > 0) {
            attributesElements.forEach((element) => {
                let name = element.querySelector(
                    `.${this.addFormId}__attr-name`
                ).value;
                let value = element.querySelector(
                    `.${this.addFormId}__attr-value`
                ).value;
                if (name !== "" && value !== "") {
                    data.set(name, value);
                }
            });
        }
        data = JSON.stringify(Object.fromEntries(data));

        // действия после успешного добавления данных в БД
        let process = (data) => {
            if (data.result == 1) {
                this.msgElement.textContent =`${data.row.articul}: ${data.row.name} добавлен`;
            } else {
                this.msgElement.textContent = data.description;
            }
        };

        let formData = new FormData(this.addForm);
        formData.set("data", data);
        // id, если редактирование
        let idAttr = this.addForm.getAttribute("data-id");
        if (idAttr) {
            formData.set("id", idAttr);
        }
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

    update(form, event) {

    }

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

    processData(row, form) {
        alert("нет реализации метода processData класса TableFrontController");
    }
}
