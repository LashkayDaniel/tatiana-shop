<template>
    <div class="block">
        <section class="products">
            <div class="products__item">Вишиванки</div>
            <div class="products__item">Бісер</div>
            <div class="products__item">Схеми вишивок</div>
            <div class="products__item">Жіночий одяг</div>
        </section>

        <section class="tags">
            <div class="tags__item">Жіночі</div>
            <div class="tags__item">Чоловічі</div>
            <div class="tags__item">Дитячі</div>
            <button class="tags__add-btn" @click="showAddNewTag=!showAddNewTag">&#10133;</button>
            <div class="tags__add-new" v-if="showAddNewTag">
                <input type="text" placeholder="Введіть назву">
                <button>Додати</button>
            </div>
        </section>

        <section class="products-list">
            <button class="products-list__btn-add">Додати товар</button>
            <table class="products-list__table">
                <tr>
                    <th>Назва товару</th>
                    <th>Опис</th>
                    <th>Ціна (грн)</th>
                    <th></th>
                </tr>
                <tr>
                    <td>Alfreds Futterkiste</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, odio.</td>
                    <td>1000</td>
                    <td>
                        <button>&#9998; edit</button>
                        <hr>
                        <button>remove</button>
                    </td>
                </tr>
                <tr>
                    <td>Alfreds Futterkiste</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, odio.</td>
                    <td>1000</td>
                    <td>
                        <button>edit</button>
                        <hr>
                        <button>remove</button>
                    </td>
                </tr>
                <tr>
                    <td>Alfreds Futterkiste</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, odio.</td>
                    <td>1000</td>
                    <td>
                        <button>edit</button>
                        <hr>
                        <button>remove</button>
                    </td>
                </tr>
                <tr>
                    <td>Alfreds Futterkiste</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, odio.</td>
                    <td>1000</td>
                    <td>
                        <button>edit</button>
                        <hr>
                        <button>remove</button>
                    </td>
                </tr>
                <tr>
                    <td>Alfreds Futterkiste</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, odio.</td>
                    <td>1000</td>
                    <td>
                        <button>edit</button>
                        <hr>
                        <button>remove</button>
                    </td>
                </tr>
                <tr>
                    <td>Alfreds Futterkiste</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, odio.</td>
                    <td>1000</td>
                    <td>
                        <button>edit</button>
                        <hr>
                        <button>remove</button>
                    </td>
                </tr>
                <tr>
                    <td>Alfreds Futterkiste</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, odio.</td>
                    <td>1000</td>
                    <td>
                        <button>edit</button>
                        <hr>
                        <button>remove</button>
                    </td>
                </tr>
                <tr>
                    <td>Alfreds Futterkiste</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, odio.</td>
                    <td>1000</td>
                    <td>
                        <button>edit</button>
                        <hr>
                        <button>remove</button>
                    </td>
                </tr>
                <tr>
                    <td>Alfreds Futterkiste</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, odio.</td>
                    <td>1000</td>
                    <td>
                        <button>edit</button>
                        <hr>
                        <button>remove</button>
                    </td>
                </tr>
                <tr>
                    <td>Alfreds Futterkiste</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, odio.</td>
                    <td>1000</td>
                    <td>
                        <button>edit</button>
                        <hr>
                        <button>remove</button>
                    </td>
                </tr>
                <tr>
                    <td>Alfreds Futterkiste</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, odio.</td>
                    <td>1000</td>
                    <td>
                        <button>edit</button>
                        <hr>
                        <button>remove</button>
                    </td>
                </tr>
                <tr>
                    <td>Alfreds Futterkiste</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, odio.</td>
                    <td>1000</td>
                    <td>
                        <button>edit</button>
                        <hr>
                        <button>remove</button>
                    </td>
                </tr>
                <tr>
                    <td>Alfreds Futterkiste</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, odio.</td>
                    <td>1000</td>
                    <td>
                        <button>edit</button>
                        <hr>
                        <button>remove</button>
                    </td>
                </tr>

            </table>
        </section>
    </div>
</template>

<script>
export default {
    name: "ProductSetting",
    data() {
        return {
            showAddNewTag: false
        }
    }
}
</script>

<style lang="scss" scoped>
@import "@/../scss/admin-page/_product-setting.scss";


</style>
