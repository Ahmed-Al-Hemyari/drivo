import { Head, useForm } from '@inertiajs/react';
import InputError from '@/components/input-error';
import { useTrans } from '@/helpers/useTrans';
import type { Booking } from '@/types/types';

type Props = {
    booking: Booking;
};

export default function Rate({ booking }: Props) {
    const { __ } = useTrans();

    const { data, setData, post, processing, errors } = useForm({
        booking_id: booking.id,
        rate: 5,
        comment: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(`/bookings/${booking.id}/rate`);
    };

    return (
        <div className="min-h-screen bg-base-200/50 text-base-content pb-16">
            <Head title={__("Rate Your Experience")} />

            <div className="max-w-xl mx-auto px-4 pt-12">
                <div className="bg-base-100 border border-base-200 p-6 sm:p-8 rounded-3xl shadow-xs">

                    <div className="text-center mb-6">
                        <h1 className="text-2xl font-black tracking-tight">{__('How was your trip?')}</h1>
                        <p className="text-sm text-base-content/60 font-medium mt-1">
                            {__('Your feedback helps us make every drive better.')}
                        </p>
                    </div>

                    <form onSubmit={handleSubmit} className="space-y-6">

                        {/* Stars Input Selector */}
                        <div className="form-control items-center flex flex-col">
                            <label className="label font-bold text-lg text-base-content/70 uppercase tracking-wider mb-2">
                                {__('Your Rating')}
                            </label>
                            <div className="rating rating-sm">
                                {[1, 2, 3, 4, 5].map((starValue) => (
                                    <input
                                        key={starValue}
                                        type="radio"
                                        name="rating-stars"
                                        className="mask mask-star-2 bg-orange-500 checked:scale-110 transition-transform"
                                        checked={data.rate === starValue}
                                        onChange={() => setData('rate', starValue)}
                                    />
                                ))}
                            </div>
                            <InputError message={errors.rate} className="mt-2" />
                        </div>

                        {/* Comment Textarea Box */}
                        <div className="form-control w-full">
                            <label className="label font-bold text-xs text-base-content/70 uppercase tracking-wider">
                                {__('Share more details (Optional)')}
                            </label>
                            <textarea
                                value={data.comment}
                                onChange={(e) => setData('comment', e.target.value)}
                                placeholder={__('Write your review here...')}
                                className={`textarea textarea-bordered w-full h-32 rounded-xl bg-base-200/50 focus:outline-none focus:border-(--color-primary-color) text-sm font-semibold p-4 ${
                                    errors.comment ? 'textarea-error' : ''
                                }`}
                            />
                            <InputError message={errors.comment} className="mt-1" />
                        </div>

                        <button
                            type="submit"
                            disabled={processing}
                            className="btn w-full bg-(--color-primary-color) hover:bg-(--color-primary-hover) border-none text-white font-bold rounded-xl shadow-md normal-case h-12 transition-all active:scale-98"
                        >
                            {processing ? (
                                <span className="loading loading-spinner loading-sm"></span>
                            ) : (
                                <>
                                    <i className="fa-solid fa-paper-plane text-xs mr-2"></i>
                                    {__('Submit Review')}
                                </>
                            )}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    );
}
