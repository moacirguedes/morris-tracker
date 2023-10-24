<script setup lang="ts">
import {useAuthStore} from "@/stores/auth";
import type {Component} from "vue";
import {h} from "vue";
import {NIcon} from 'naive-ui'
import {
  PersonCircle12Regular as UserIcon,
  PersonEdit20Regular as EditIcon,
  SignOut20Regular as LogoutIcon
} from '@vicons/fluent'

const auth = useAuthStore()

const renderIcon = (icon: Component) => {
  return () => {
    return h(NIcon, null, {
      default: () => h(icon)
    })
  }
}

const options = [
  {
    label: 'Profile',
    icon: renderIcon(UserIcon)
  },
  {
    label: 'Edit Profile',
    icon: renderIcon(EditIcon)
  },
  {
    label: 'Logout',
    icon: renderIcon(LogoutIcon),
    props: {
      onClick: () => {
        auth.logout()
      }
    }
  }
]
</script>

<template>
  <n-page-header>
    <template #default>
      <nav v-if="auth.loginStatus()">
        <RouterLink to="/">Home</RouterLink>
        <n-divider vertical />
        <RouterLink :to="{name: 'about'}">About</RouterLink>
        <n-divider vertical />
        <n-dropdown :options="options">
          <n-button :bordered="false" style="padding: 0 4px">· · ·</n-button>
        </n-dropdown>
      </nav>
      <nav v-if="!auth.loginStatus()">
        <RouterLink :to="{name: 'login'}">Login</RouterLink>
        <n-divider vertical />
        <RouterLink :to="{name: 'register'}">Register</RouterLink>
      </nav>
    </template>
  </n-page-header>
</template>

<style scoped lang="scss">

nav {
  text-align: center;
  font-size: 20px;
  padding: 1rem 0;
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

</style>