<script setup lang="ts">
import {NDialogProvider, NLoadingBarProvider, NMessageProvider, NNotificationProvider,} from 'naive-ui'
import HeaderComponent from "@/components/HeaderComponent.vue";
</script>

<template>
  <n-dialog-provider>
    <n-message-provider>
      <n-notification-provider>
        <n-loading-bar-provider>
          <HeaderComponent/>
          <RouterView/>
        </n-loading-bar-provider>
      </n-notification-provider>
    </n-message-provider>
  </n-dialog-provider>
</template>
