import { Form, Head } from '@inertiajs/react';
import InputError from '@/components/input-error';
import PasswordInput from '@/components/password-input';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { useTrans } from '@/helpers/useTrans';
import { register } from '@/routes';
import { store } from '@/routes/login';

type Props = {
    status?: string;
    canResetPassword: boolean;
};

const handleGoogleLogin = () => {
    window.location.href = '/oauth/google/redirect';
};

export default function Login({ status }: Props) {
    const { __ } = useTrans();

    return (
        <>
            <Head title="Log in" />

            {/* <PasskeyVerify /> */}

            <Form
                {...store.form()}
                resetOnSuccess={['password']}
                className="flex flex-col gap-6"
            >
                {({ processing, errors }) => (
                    <>
                        <div className="grid gap-6">
                            <div className="grid gap-2">
                                <Label htmlFor="email">{__("Email address")}</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    name="email"
                                    required
                                    autoFocus
                                    tabIndex={1}
                                    autoComplete="email"
                                    placeholder="email@example.com"
                                />
                                <InputError message={errors.email} />
                            </div>

                            <div className="grid gap-2">
                                <div className="flex items-center">
                                    <Label htmlFor="password">{__("Password")}</Label>
                                    {/* {canResetPassword && (
                                        <TextLink
                                            href={request()}
                                            className={`${locale == 'ar' ? 'mr-auto' : 'ml-auto'} text-sm`}
                                            tabIndex={5}
                                        >
                                            {__("Forgot your password?")}
                                        </TextLink>
                                    )} */}
                                </div>
                                <PasswordInput
                                    id="password"
                                    name="password"
                                    required
                                    tabIndex={2}
                                    autoComplete="current-password"
                                    placeholder={__("Password")}
                                />
                                <InputError message={errors.password} />
                            </div>

                            <div className="flex items-center space-x-3">
                                <Checkbox
                                    id="remember"
                                    name="remember"
                                    tabIndex={3}
                                />
                                <Label htmlFor="remember">{__("Remember me")}</Label>
                            </div>

                            <Button
                                type="submit"
                                className="mt-4 w-full bg-(--color-primary-color) hover:bg-(--color-primary-hover)"
                                tabIndex={4}
                                disabled={processing}
                                data-test="login-button"
                            >
                                {processing && <Spinner />}
                                {__("Log in")}
                            </Button>
                            <div className="relative my-6">
                                <div className="absolute inset-0 flex items-center">
                                    <div className="w-full border-t border-base-200/80"></div>
                                </div>
                                <div className="relative flex justify-center text-xs uppercase font-bold tracking-wider">
                                    <span className="bg-base-100 px-3 text-base-content/40">{__('Or log in with')}</span>
                                </div>
                            </div>

                            {/* OAuth Provider Grid */}
                            <div className="grid grid-cols-1 gap-3 w-full">
                                {/* ─── Google Gradient Border Wrapper (Stays bright on both themes) ─── */}
                                <div className="bg-gradient-to-r from-[#EA4335] via-[#FBBC05] via-[#34A853] to-[#4285F4] p-[1.5px] rounded-2xl transition-all duration-200 active:scale-[0.98]">

                                    <button
                                        type="button"
                                        onClick={() => handleGoogleLogin()}
                                        className="w-full bg-base-100 dark:bg-[#1e232d] hover:bg-base-200/70 dark:hover:bg-[#252b37] rounded-[14px] h-16 px-5 flex items-center justify-center gap-4 transition-colors duration-200"
                                    >
                                        {/* Left: Prominent Google Icon */}
                                        <img
                                            src="/images/google-logo.png"
                                            alt="Google"
                                            className="h-8 w-8 object-contain"
                                        />

                                        {/* Right: Stacked Text Fields */}
                                        <div className="flex flex-col items-start text-left">
                                            <span className="text-base-content dark:text-white font-bold text-base tracking-tight leading-tight">
                                                {__('Continue with Google')}
                                            </span>
                                            <span className="text-base-content/60 dark:text-gray-400 text-xs font-medium mt-0.5">
                                                {__('One-click sign in')}
                                            </span>
                                        </div>

                                    </button>

                                </div>
                            </div>
                        </div>

                        <div className="text-center text-sm text-muted-foreground">
                            {__("Don't have an account? ")}
                            <TextLink href={register()} tabIndex={5}>
                                {__('Sign up')}
                            </TextLink>
                        </div>
                    </>
                )}
            </Form>

            {status && (
                <div className="mb-4 text-center text-sm font-medium text-green-600">
                    {status}
                </div>
            )}
        </>
    );
}

// Login.layout = {
//     title: ('Log in to your account'),
//     description: ('Enter your email and password below to log in'),
// };
