/** Фронт-контроллер таблицы */
class ProductClientController extends ClientController {
    /** создать строку таблицы
     *
     * @param {*} data данные из БД
     */
    processData(row) {
      this.table.innerHTML += `
      <tr class='table-product__tr relative' id="product-${row.id}">
          <td class='p-3 border-e border-black'>
              <span>${row.articul}</span>
              <div class='inline float-right'>
                  <button class='product__btn-edit opacity-50' title='Редактировать'>✎</button>
                  <button class='product__btn-remove opacity-50' title='Удалить'>🗑</button>
              </div>
          </td>
          <td class='p-3 text-center border-e border-black'>${row.name}</td>
          <td class='p-3 text-end border-e border-black'>${row.color}</td>
          <td class='p-3 text-end'>${row.size}</td>
      </tr>
      `;
      this.setListeners();
      this.clearForm();
    }

    setListeners() {
        this.table.querySelectorAll(".product__btn-remove").forEach((btn) => {
            btn.onclick = () => remove(btn.closest("tr").id);
        });
        this.table.querySelectorAll(".product__btn-edit").forEach((btn) => {
            btn.onclick = () => editRowClick(btn.closest("tr"));
        });
    }

    clearForm() {
        this.form.reset();
        document.querySelector('.form-new-product_btn-back').classList.add('hidden');
        this.form.setAttribute("data-type", 'add');
        document.querySelector('.form-new-product_btn-submit').value = 'Добавить';
        this.msgElement.textContent = '';
    }
}
