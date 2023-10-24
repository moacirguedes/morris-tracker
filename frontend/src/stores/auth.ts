import {ref} from 'vue'
import {defineStore} from 'pinia'
import type {LoginType, UserType} from "@/models/UserInterface";
import {loginUser, postUser} from "@/services/ApiService";
import {useLoadingBar, useMessage} from "naive-ui";
import {useRouter} from "vue-router";
import type {ApiType} from "@/models/ApiInterface";

export const useAuthStore = defineStore('auth', () => {
    const token = ref('')
    const name = ref('')
    const id = ref('')

    const message = useMessage()
    const loadingBar = useLoadingBar()
    const router = useRouter()
    const saveUser = (response: ApiType) => {
        token.value = response.data!.token!
        name.value = response.data!.user!.name
        id.value = response.data!.user!.id

        router.push({name: 'home'}).then(() => {
            loadingBar.finish()
        })
    }

    function register(user: UserType) {
        loadingBar.start()

        postUser(user).then(response => {
            if (response.success)
                saveUser(response)
            else {
                for (const key in response.errors! as Object) {
                    const errors = (response.errors as any)[key]
                    for (const error of errors) {
                        message.error(error, {duration: 5000})
                    }
                    loadingBar.error()
                }
            }
        })
    }

    function login(user: LoginType) {
        loadingBar.start()
        loginUser(user).then(response => {
            if (response.success)
                saveUser(response)
            else {
                message.error(`${response.errors}`, {duration: 3000})
                loadingBar.error()
            }
        })
    }

    function logout() {
        loadingBar.start()
        token.value = ''
        name.value = ''
        id.value = ''

        router.push({name: 'login'}).then(() => {
            loadingBar.finish()
        })
    }

    function loginStatus(): boolean {
        return token.value !== '';
    }

    return {token, name, id, login, register, logout, loginStatus}
}, {persist: true})
