import HttpService from "@/services/HttpService";
import type {LoginType, UserType} from "@/models/UserInterface";
import type {ApiType} from "@/models/ApiInterface";

export const postUser = async (user: UserType): Promise<ApiType> => {
    try {
        const {data} = await HttpService.post('user', user)
        return data
    } catch (e) {
        throw new Error(`Api request failed with errors: ${e}`)
    }
}

export const loginUser = async (user: LoginType): Promise<ApiType> => {
    try {
        const {data} = await HttpService.post('login', user)
        return data
    } catch (e) {
        throw new Error(`Api request failed with errors: ${e}`)
    }
}