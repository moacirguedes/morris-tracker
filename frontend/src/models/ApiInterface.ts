export interface ApiType {
    success: boolean
    status: number
    data: DataType | null
    errors: Object | null | string
}

interface DataType {
    token: string | null
    user: UserType | null
}

interface UserType {
    name: string
    email: string
    id: string
}
