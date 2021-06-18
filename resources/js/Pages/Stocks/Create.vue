<template>
    <div>
        <Layout>
            <div class="flex justify-center w-full">
                <div class="bg-white flex flex-col w-1/3 mt-10 p-6">
                    <h2 class="text-lg">Stocks Form</h2>
                    <form
                        id="stock-form"
                        name="stock-form"
                        v-on:submit.prevent="submit"
                    >
                        <div class="flex flex-col pt-6">
                            <label for="id">ID</label>
                            <input
                                type="text"
                                id="id"
                                name="id"
                                v-model="form.id"
                            />
                            <div class="text-red-700 text-sm">
                                {{ errors.id }}
                            </div>
                            {{ form.id }}
                        </div>

                        <div class="flex flex-col pt-6">
                            <label for="stock_categorys">Stock Category ID</label>
                            <select id="stock_categorys" v-model="form.stock_categorys">
                                <option v-for="item in stock_categorys" :key="item.id" v-bind:value="item.id">{{item.id}}</option>
                            </select>
                            <!--<select name="stock_categorys" id="stock_categorys" v-model="form.stock_categorys">
                                <option v-for="item in stock_categorys" v-bind:value="item.id">{{item.id}}</option>                                
                            </select>-->
                            <div class="text-red-700 text-sm">
                                {{ errors.stock_categorys }}
                            </div>
                        </div>

                        <div class="flex flex-col pt-6">
                            <label for="description">Description</label>
                            <input
                                type="text"
                                id="description"
                                name="description"
                                v-model="form.description"
                                
                            />
                            <div class="text-red-700 text-sm">
                                {{ errors.description }}
                            </div>
                        </div>

                        <div class="flex flex-col pt-6">
                            <label for="uom">UOM</label>
                            <input
                                type="text"
                                id="uom"
                                name="uom"
                                v-model="form.uom"
                            />
                            <div class="text-red-700 text-sm">
                                {{ errors.uom }}
                            </div>
                        </div>

                        <div class="flex flex-col pt-6">
                            <label for="barcode">Barcode</label>
                            <input
                                type="text"
                                id="barcode"
                                name="barcode"
                                v-model="form.barcode"
                            />
                            <div class="text-red-700 text-sm">
                                {{ errors.barcode }}
                            </div>
                        </div>

                        <div class="flex flex-col pt-6">
                            <label for="discontinued">Discontinued?
                            <input class="mr-2" type="checkbox" id="discontinued" name="discontinued" true-value="Y" false-value="N"
                                v-model="form.discontinued"/>Yes
                            <input class="mr-2" type="checkbox" id="discontinued" name="discontinued" true-value="N" false-value="Y"
                                v-model="form.discontinued"/>No</label>
                            <!--
                            <input
                                type="checkbox"
                                id="discontinued"
                                name="discontinued"
                                value="{{ old('discontinued', isset($discontinued) ? 'checked' : 'Y') }}"
                                v-model="form.discontinued"
                                class="ml-2"
                            />  Yes</label>-->
                            <div class="text-red-700 text-sm">
                                {{ errors.discontinued }}
                            </div>
                        </div>

                        <div class="flex flex-col pt-6">
                            <button
                                type="submit"
                                class="bg-indigo-800 text-white p-2"
                            >
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </Layout>
    </div>
</template>

<script>
import { ref, reactive } from "vue";
import Layout from "@/Layouts/Authenticated";
import { Inertia } from "@inertiajs/inertia";
export default {
    components: {
        Layout,
    },
    props: {
        errors: Object,
        stock_categorys: Array
    },
    setup(props, context) {
        const form = reactive({
            id: null,
            stock_categorys: null,
            description: null,
            uom: null,
            barcode: null,
            discontinued: null,
            photo_path: null,
        });
        const submit = () => {
            Inertia.post(route("stock.store"), form, {
                onSuccess: () => {
                    // Handle success event
                    form.id = null;
                    form.stock_categorys = null;
                    form.description = null;
                    form.uom = null;
                    form.barcode = null;
                    form.discontinued = null;
                    form.photo_path = null;
                    //   this.reset();
                },
            });
        };
        return {
            form,
            submit,
        };
    },
};
</script>