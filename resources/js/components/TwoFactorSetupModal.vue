<script setup lang="ts">
import AlertError from '@/components/AlertError.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Spinner } from '@/components/ui/spinner';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import {
    PinInput,
    PinInputGroup,
    PinInputSlot,
} from '@/components/ui/pin-input';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import { confirm } from '@/routes/two-factor';
import { Form } from '@inertiajs/vue3';
import { useClipboard } from '@vueuse/core';
import { Check, Copy, ScanLine } from 'lucide-vue-next';
import { computed, nextTick, ref, useTemplateRef, watch } from 'vue';

interface Props {
    requiresConfirmation: boolean;
    twoFactorEnabled: boolean;
}

const props = defineProps<Props>();
const isOpen = defineModel<boolean>('isOpen');

const { copy, copied } = useClipboard();
const { qrCodeSvg, manualSetupKey, clearSetupData, fetchSetupData, errors } =
    useTwoFactorAuth();

const showVerificationStep = ref(false);
const code = ref<number[]>([]);
const codeValue = computed<string>(() => code.value.join(''));

const pinInputContainerRef = useTemplateRef('pinInputContainerRef');

const modalConfig = computed<{
    title: string;
    description: string;
    buttonText: string;
}>(() => {
    if (props.twoFactorEnabled) {
        return {
            title: 'Two-Factor Authentication Enabled',
            description:
                'Two-factor authentication is now enabled. Scan the QR code or enter the setup key in your authenticator app.',
            buttonText: 'Close',
        };
    }

    if (showVerificationStep.value) {
        return {
            title: 'Verify Authentication Code',
            description: 'Enter the 6-digit code from your authenticator app',
            buttonText: 'Continue',
        };
    }

    return {
        title: 'Enable Two-Factor Authentication',
        description:
            'To finish enabling two-factor authentication, scan the QR code or enter the setup key in your authenticator app',
        buttonText: 'Continue',
    };
});

const handleModalNextStep = () => {
    if (props.requiresConfirmation) {
        showVerificationStep.value = true;

        nextTick(() => {
            pinInputContainerRef.value?.querySelector('input')?.focus();
        });

        return;
    }

    clearSetupData();
    isOpen.value = false;
};

const resetModalState = () => {
    if (props.twoFactorEnabled) {
        clearSetupData();
    }

    showVerificationStep.value = false;
    code.value = [];
};

watch(
    () => isOpen.value,
    async (isOpen) => {
        if (!isOpen) {
            resetModalState();
            return;
        }

        if (!qrCodeSvg.value) {
            await fetchSetupData();
        }
    },
);
</script>

<template>
    <Dialog :open="isOpen" @update:open="isOpen = $event">
        <DialogContent class="">
            <DialogHeader class="">
                <div
                    class=""
                >
                    <div
                        class=""
                    >
                        <div
                            class=""
                        >
                            <div
                                v-for="i in 5"
                                :key="`col-${i}`"
                                class=""
                            />
                        </div>
                        <div
                            class=""
                        >
                            <div
                                v-for="i in 5"
                                :key="`row-${i}`"
                                class=""
                            />
                        </div>
                        <ScanLine
                            class=""
                        />
                    </div>
                </div>
                <DialogTitle>{{ modalConfig.title }}</DialogTitle>
                <DialogDescription class="">
                    {{ modalConfig.description }}
                </DialogDescription>
            </DialogHeader>

            <div
                class=""
            >
                <template v-if="!showVerificationStep">
                    <AlertError v-if="errors?.length" :errors="errors" />
                    <template v-else>
                        <div
                            class=""
                        >
                            <div
                                class=""
                            >
                                <div
                                    v-if="!qrCodeSvg"
                                    class=""
                                >
                                    <Spinner class="" />
                                </div>
                                <div
                                    v-else
                                    class=""
                                >
                                    <div
                                        v-html="qrCodeSvg"
                                        class=""
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <Button class="" @click="handleModalNextStep">
                                {{ modalConfig.buttonText }}
                            </Button>
                        </div>

                        <div
                            class=""
                        >
                            <div
                                class=""
                            />
                            <span class=""
                                >or, enter the code manually</span
                            >
                        </div>

                        <div
                            class=""
                        >
                            <div
                                class=""
                            >
                                <div
                                    v-if="!manualSetupKey"
                                    class=""
                                >
                                    <Spinner />
                                </div>
                                <template v-else>
                                    <input
                                        type="text"
                                        readonly
                                        :value="manualSetupKey"
                                        class=""
                                    />
                                    <button
                                        @click="copy(manualSetupKey || '')"
                                        class=""
                                    >
                                        <Check
                                            v-if="copied"
                                            class=""
                                        />
                                        <Copy v-else class="" />
                                    </button>
                                </template>
                            </div>
                        </div>
                    </template>
                </template>

                <template v-else>
                    <Form
                        v-bind="confirm.form()"
                        reset-on-error
                        @finish="code = []"
                        @success="isOpen = false"
                        v-slot="{ errors, processing }"
                    >
                        <input type="hidden" name="code" :value="codeValue" />
                        <div
                            ref="pinInputContainerRef"
                            class=""
                        >
                            <div
                                class=""
                            >
                                <PinInput
                                    id="otp"
                                    placeholder="○"
                                    v-model="code"
                                    type="number"
                                    otp
                                >
                                    <PinInputGroup>
                                        <PinInputSlot
                                            autofocus
                                            v-for="(id, index) in 6"
                                            :key="id"
                                            :index="index"
                                            :disabled="processing"
                                        />
                                    </PinInputGroup>
                                </PinInput>
                                <InputError
                                    :message="
                                        errors?.confirmTwoFactorAuthentication
                                            ?.code
                                    "
                                />
                            </div>

                            <div class="">
                                <Button
                                    type="button"
                                    variant="outline"
                                    class=""
                                    @click="showVerificationStep = false"
                                    :disabled="processing"
                                >
                                    Back
                                </Button>
                                <Button
                                    type="submit"
                                    class=""
                                    :disabled="
                                        processing || codeValue.length < 6
                                    "
                                >
                                    Confirm
                                </Button>
                            </div>
                        </div>
                    </Form>
                </template>
            </div>
        </DialogContent>
    </Dialog>
</template>
