import { Head, useForm } from '@inertiajs/react';
import InputError from '@/components/input-error';
import PasswordInput from '@/components/password-input';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { useTrans } from '@/helpers/useTrans';

type Props = {
    token: string;
    passwordRules: string;
};

export default function ResetPassword({ token, passwordRules }: Props) {
    const { __ } = useTrans();

    // 💡 Use standard Inertia form tracking at the top level
    const { data, setData, post, processing, errors, reset } = useForm({
        token: token,
        old_password: '',
        new_password: '',
        new_password_confirmation: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        // Replace this string route path with your password update backend route URL
        post('/update-password', {
            onSuccess: () => reset('old_password', 'new_password', 'new_password_confirmation'),
        });
    };

    return (
        <>
            <Head title={__("Reset password")} />

            {/* 💡 Plain standard HTML form to handle submission cleanly */}
            <form onSubmit={handleSubmit} className="grid gap-6">

                {/* Old Password Field */}
                <div className="grid gap-2">
                    <Label htmlFor="old_password">{__("Old password")}</Label>
                    <PasswordInput
                        id="old_password"
                        name="old_password"
                        autoComplete="current-password"
                        className="mt-1 block w-full"
                        autoFocus
                        placeholder={__("Old password")}
                        passwordrules={passwordRules}
                        value={data.old_password}
                        onChange={(e) => setData('old_password', e.target.value)}
                    />
                    <InputError message={errors.old_password} />
                </div>

                {/* New Password Field */}
                <div className="grid gap-2">
                    <Label htmlFor="new_password">{__("New password")}</Label>
                    <PasswordInput
                        id="new_password"
                        name="new_password"
                        autoComplete="new-password"
                        className="mt-1 block w-full"
                        placeholder={__("New password")}
                        passwordrules={passwordRules}
                        value={data.new_password}
                        onChange={(e) => setData('new_password', e.target.value)}
                    />
                    <InputError message={errors.new_password} />
                </div>

                {/* Password Confirmation Field */}
                <div className="grid gap-2">
                    <Label htmlFor="new_password_confirmation">
                        {__("Confirm new password")}
                    </Label>
                    <PasswordInput
                        id="new_password_confirmation"
                        name="new_password_confirmation"
                        autoComplete="new-password"
                        className="mt-1 block w-full"
                        placeholder={__("Confirm new password")}
                        passwordrules={passwordRules}
                        value={data.new_password_confirmation}
                        onChange={(e) => setData('new_password_confirmation', e.target.value)}
                    />
                    <InputError message={errors.new_password_confirmation} className="mt-2" />
                </div>

                <Button
                    type="submit"
                    className="mt-4 w-full bg-(--color-primary-color) hover:bg-(--color-primary-hover)"
                    disabled={processing}
                    data-test="reset-password-button"
                >
                    {processing && <Spinner />}
                    {__('Reset password')}
                </Button>
            </form>
        </>
    );
}
