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
            return axiosClient.get('/getCategories')
                .then(({ data }) => {
                    commit('setCategories', data);
                    return data;
                })
        },
        getSubcategories({ commit }) {
            return axiosClient.get('/getSubcategories')
                .then(({ data }) => {
                    commit('setSubcategories', data);
                    return data;
                })
        },
        getProducts({ commit }) {
            return axiosClient.get('/getProducts')
                .then(({ data }) => {
                    commit('setProducts', data);
                    return data;
                })
        },
    },
    mutations: {
        setCategories: (state, categoriesData) => {
            state.categories = categoriesData;
        },
        setSubcategories: (state, subcategoriesData) => {
            state.subcategories = subcategoriesData;
        },
        setProducts: (state, productsData) => {
            state.subcategories = productsData;
        },
    },
});

export default store;