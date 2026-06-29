import { User } from "./auth";

export enum TransactionType {
    income = 0,
    expense = 1
}

export type Brand = {
    id: number;
    name_en: string;
    name_ar: string;
    logo?: string;
    url?: string;
}

export type Category = {
    id: number;
    name_en: string;
    name_ar: string;
}

export type LinkItem = {
    url: string | null;
    label: string;
    active: boolean;
}

export type Car = {
    id: number;
    name_en: string;
    name_ar: string;
    daily_price: number;
    images?: Array<string>;
    rate?: number | null;
    is_available: boolean;

    unavailable_dates: Array<string>;

    brand_id: number;
    category_id: number;

    brand?: Brand;
    category?: Category;
}

export type BookingStatus = {
    id: number;
    name_en: string;
    name_ar: string;
    background_color?: string;
    font_color?: string;
}

export type Booking = {
    id: number;
    start_date: string;
    end_date: string;
    total_price: number;
    notes: string;
    rated: boolean;

    // Model
    title: string;
    duration: number;
    amount: number;
    VAT: number;
    total_amount_with_VAT: number;
    total_paid: number;
    total_remaining: number;

    booking_status_id: number;
    user_id: number;
    car_id: number;

    booking_status?: BookingStatus;
    user?: User;
    car?: Car;
}

export type Review = {
    id: number;
    rate: number;
    comment: string;

    booking_id: number;
    booking?: Booking;
}

export type MoneyTransaction = {
    id: number;
    transaction_date: string;
    amount: number;
    transaction_type: TransactionType;
    atm: boolean;
    notes: string;

    booking_id: number;

    booking?: Booking;
}
