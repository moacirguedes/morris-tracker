<script setup lang="ts">
import {computed, ref} from "vue";
import {
  type FormInst,
  type FormItemRule,
  type FormRules,
  type FormValidationError,
} from 'naive-ui'
import type {UserType} from "@/models/UserInterface";
import {useAuthStore} from "@/stores/auth";

const auth = useAuthStore()
const formSignUp = ref<FormInst | null>(null)
const userRef = ref<UserType>({
  name: null,
  email: null,
  password: null,
  password_confirmation: null
})

function validatePasswordSame(rule: FormItemRule, value: string): boolean {
  return value === userRef.value.password
}

const rules: FormRules = {
  name: [
    {
      required: true,
      validator(rule: FormItemRule, value: string) {
        if (!value) {
          return new Error('Name is required')
        }
        return true
      },
      trigger: ['name-input', 'blur']
    }
  ],
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
  ],
  password_confirmation: [
    {
      required: true,
      message: 'Re-entered password is required',
      trigger: ['password_confirmation-input', 'blur']
    },
    {
      validator: validatePasswordSame,
      message: 'Password is not same as re-entered password!',
      trigger: ['password_confirmation-input', 'blur']
    }
  ]
}

const autoCompleteOptions = computed(() => {
  return ['@gmail.com', '@outlook.com', '@icloud.com'].map((suffix) => {
    const prefix = userRef.value.email?.split('@')[0]
    return {
      label: prefix + suffix,
      value: prefix + suffix
    }
  })
})

function handleValidateButtonClick(e: MouseEvent) {
  e.preventDefault()
  formSignUp.value?.validate((errors: Array<FormValidationError> | undefined) => {
    if (!errors) {
      auth.register(userRef.value)
    }
  })
}
</script>

<template>
  <n-card title="Register">
    <n-form ref="formSignUp" :model="userRef" :rules="rules">
      <n-form-item path="name" label="Name">
        <n-input v-model:value="userRef.name" @keydown.enter.prevent/>
      </n-form-item>
      <n-form-item label="E-mail" path="email">
        <n-auto-complete
            v-model:value="userRef.email"
            :options="autoCompleteOptions"
            placeholder="E-mail"
        />
      </n-form-item>
      <n-form-item path="password" label="Password">
        <n-input
            v-model:value="userRef.password"
            type="password"
            @keydown.enter.prevent
        />
      </n-form-item>
      <n-form-item
          path="password_confirmation"
          label="Re-enter Password"
      >
        <n-input
            v-model:value="userRef.password_confirmation"
            :disabled="!userRef.password"
            type="password"
            @keydown.enter.prevent
        />
      </n-form-item>
      <n-row :gutter="[0, 24]">
        <n-col :span="24">
          <div style="display: flex; justify-content: flex-end">
            <n-button
                :disabled="userRef.email === null || userRef.password_confirmation === null || userRef.name === null"
                round
                type="primary"
                @click="handleValidateButtonClick"
            >
              Submit
            </n-button>
          </div>
        </n-col>
      </n-row>
    </n-form>
  </n-card>
</template>

<style scoped lang="scss">

</style>