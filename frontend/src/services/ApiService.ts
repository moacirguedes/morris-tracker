import HttpService from "@/services/HttpService";
import type {UserType} from "@/models/UserInterface";
import type {ApiInterface} from "@/models/ApiInterface";

export const postUser = async (user: UserType): Promise<ApiInterface|any> => {
    try {
        const {data} = await HttpService.post('user', user)
        return data
    }
    catch (e) {
        return e
    }
}