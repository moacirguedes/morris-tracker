<script setup lang="ts">
import {computed, ref} from "vue";
import {type FormInst, type FormItemRule, type FormRules, type FormValidationError, useLoadingBar,} from 'naive-ui'
import type {LoginType} from "@/models/UserInterface";
import {useAuthStore} from "@/stores/auth";

const auth = useAuthStore()
const formSignIn = ref<FormInst | null>(null)
const loginRef = ref<LoginType>({
  email: '',
  password: '',
})

const rules: FormRules = {
  email: [
    {
      required: true,
      validator(rule: FormItemRule, value: string) {
        if (!RegExp('^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+.)+[a-zA-Z]{2,4}$').test(value)) {
          return new Error('Invalid e-mail')
        }
        return true
      },
      trigger: ['email-input', 'blur']
    }
  ],
  password: [
    {
      required: true,
      message: 'Password is required',
      trigger: ['password-input', 'blur']
    }
  ]
}

const autoCompleteOptions = computed(() => {
  return ['@gmail.com', '@outlook.com', '@icloud.com'].map((suffix) => {
    const prefix = loginRef.value.email?.split('@')[0]
    return {
      label: prefix + suffix,
      value: prefix + suffix
    }
  })
})

function handleValidateButtonClick(e: MouseEvent) {
  e.preventDefault()
  formSignIn.value?.validate((errors: Array<FormValidationError> | undefined) => {
    if (!errors) {
      auth.login(loginRef.value)
    }
  })
}
</script>

<template>
  <n-card title="Login">
    <n-form ref="formSignIn" :model="loginRef" :rules="rules">
      <n-form-item label="E-mail" path="email">
        <n-auto-complete
            v-model:value="loginRef.email"
            :options="autoCompleteOptions"
            placeholder="E-mail"
        />
      </n-form-item>
      <n-form-item path="password" label="Password">
        <n-input
            v-model:value="loginRef.password"
            type="password"
        />
      </n-form-item>
      <n-row :gutter="[0, 24]">
        <n-col :span="24">
          <div style="display: flex; justify-content: flex-end">
            <n-button
                :disabled="loginRef.email === '' || loginRef.password === ''"
                round
                type="primary"
                @click="handleValidateButtonClick"
            >
              Login
            </n-button>
          </div>
        </n-col>
      </n-row>
    </n-form>
  </n-card>
</template>

<style scoped lang="scss">

</style>