export interface UserType {
    name: string | null
    email: string | null
    password: string | null
    password_confirmation: string | null
}

export interface LoginType {
    email: string
    password: string
}