import { createStore } from "vuex";
import axiosClient from "../axios";

const store = createStore({
    state: {
        categories: [],
        subcategories: [],
        products: [],
    },
    getters: {},
    actions: {
        getCategories({ commit }) {
            return axiosClient.get("/getCategories").then(({ data }) => {
                commit("setCategories", data);
                return data;
            });
        },
        getSubcategories({ commit }) {
            return axiosClient.get("/getSubcategories").then(({ data }) => {
                commit("setSubcategories", data);
                return data;
            });
        },
        getProducts({ commit }) {
            return axiosClient.get("/getProducts").then(({ data }) => {
                commit("setProducts", data);
                return data;
            });
        },
        storeCategory({ commit }, newCategory) {
            return axiosClient
                .post("/storeCategory", newCategory)
                .then((response) => {
                    return response;
                });
        },
        storeSubcategory({ commit }, newSubcategory) {
            return axiosClient
                .post("/storeSubcategory", newSubcategory)
                .then((response) => {
                    return response;
                });
        },
        storeProduct({ commit }, newProduct) {
            return axiosClient
                .post("/storeProduct", newProduct)
                .then((response) => {
                    return response;
                });
        },
        deleteProduct({ commit }, product) {
            return axiosClient
                .post("/deleteProduct", product)
                .then((response) => {
                    return response;
                });
        },
        deleteCategory({ commit }, category) {
            return axiosClient
                .post("/deleteCategory", category)
                .then((response) => {
                    return response;
                });
        },
        deleteSubcategory({ commit }, subcategory) {
            return axiosClient
                .post("/deleteSubcategory", subcategory)
                .then((response) => {
                    return response;
                });
        },
        editCategory({ commit }, category) {
            return axiosClient
                .post("/editCategory", category)
                .then((response) => {
                    return response;
                });
        },
        editSubcategory({ commit }, subcategory) {
            return axiosClient
                .post("/editSubcategory", subcategory)
                .then((response) => {
                    return response;
                });
        },
        editProduct({ commit }, product) {
            return axiosClient
                .post("/editProduct", product)
                .then((response) => {
                    return response;
                });
        },
    },
    mutations: {
        setCategories: (state, categoriesData) => {
            state.categories = categoriesData;
            for (var i = 0; i < state.categories.length; i++) {
                state.categories[i].collapsed = true;
                state.categories[i].editing = false;
            }
        },
        setSubcategories: (state, subcategoriesData) => {
            state.subcategories = subcategoriesData;
            for (var i = 0; i < state.subcategories.length; i++) {
                state.subcategories[i].collapsed = true;
                state.subcategories[i].editing = false;
            }
        },
        setProducts: (state, productsData) => {
            state.products = productsData;
            for (let i = 0; i < state.products.length; i++) {
                state.products[i].editing = false;
            }
        },
    },
});

export default store;