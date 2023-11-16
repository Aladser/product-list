/** Клиентский табличный контроллер */
class ClientController {
    /** Клиентский табличный контроллер
     * @param {*} URL URL бэк-контроллера
     * @param {*} table  таблица тем
     * @param {*} msgElement инфоэлемент
     * @param {*} form форма добавления элемента
     */
    constructor(URL, table, msgElement, form) {
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
    }

    // добавить запись в БД
    add(form, event) {
        event.preventDefault();
        // действия после успешного добавления данных в БД
        let process = (data) => {
            console.log(data);
            if (data.result == 1) {
                this.processData(data.row, form);
            } else {
                this.msgElement.textContent = data.description;
            }
        };

        // данные формы
        let formData = new FormData(form);
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

    update() {
        
    }
    processData(row, form) {
        alert("нет реализации метода processData класса TableFrontController");
    }
}
