/** Фронт-контроллер таблицы */
class ProductClientController {
    constructor(URL, table, msgElement, form = null, formClass) {
        this.URL = URL;
        this.table = table;
        this.msgElement = msgElement;
        this.form = form;
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

        // форма добавления нового элемента
        if (this.form) {
            this.form.onsubmit = (event) => this.add(form, event);
        }
        this.formClass = formClass;
        //let type = form.getAttribute("data-type");
    }

    
    // добавить запись в БД
    add(form, event) {
        event.preventDefault();

        // атрибуты
        let data = new Map();
        let attributesElements = document.querySelectorAll(
            `.${this.formClass}__attribute`
        );
        if (attributesElements.length > 0) {
            attributesElements.forEach((element) => {
                let name = element.querySelector(
                    `.${this.formClass}__attr-name`
                ).value;
                let value = element.querySelector(
                    `.${this.formClass}__attr-value`
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

        let formData = new FormData(form);
        formData.set("data", data);
        // id, если редактирование
        let idAttr = form.getAttribute("data-id");
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
