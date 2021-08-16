<script>
export default {
  methods: {
    notifyIcon(type) {
      type = type || 'info'
      let icon = ''
      switch (type) {
        case 'success':
          icon = '<i class="uil uil-check-circle"></i>'
          break
        case 'danger':
          icon = '<i class="uil uil-exclamation-octagon"></i>'
        case 'warning':
          icon = '<i class="uil uil-exclamation-triangle"></i>'
          break
        case 'info':
          icon = '<i class="uil uil-question-circle"></i>'
          break
      }
      return icon
    },
    notifyTitle(type) {
      type = type || 'info'
      let title = ''
      switch (type) {
        case 'success':
          title = 'Éxito!!!'
          break
        case 'danger':
          title = 'Error!!!'
        case 'warning':
          title = 'Aviso!!!'
          break
        case 'info':
          title = 'Info!!!'
          break
      }
      return title
    }
  }
}
</script>
<template>
  <div class="noti-container">
    <notifications :duration="5000" :width="500" animation-name="v-fade-left" position="top right">
      <template slot="body" slot-scope="props">
        <div :class="`noti-cp noti-` + props.item.type">
          <div class="noti-cp-icon" v-html="notifyIcon(props.item.type)"></div>
          <div class="noti-cp-content">
            <div class="noti-cp-title" v-html="notifyTitle(props.item.type)"></div>
            <div class="noti-cp-text">
              <p v-html="props.item.text"></p>
            </div>
          </div>
          <div class="noti-cp-close" @click="props.close">
            <i class="uil uil-multiply"></i>
          </div>
        </div>
      </template>
    </notifications>
  </div>
</template>
<style lang="scss" scoped>
.noti-container::v-deep {
  .noti-cp {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    text-align: left;
    font-size: 13px;
    margin: 5px;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    box-shadow: 0px 2px 4px 0 hsl(0deg 0% 0% / 20%);
    &,
    & > div {
      box-sizing: border-box;
    }
    &.noti-success {
      color: #1f7556;
      background-color: #d6f3e9;
      border-color: #c2eddd;
      .noti-cp-icon,
      .noti-cp-title {
        color: #34c38f;
      }
    }
    &.noti-danger {
      color: #924040;
      background-color: #fde1e1;
      border-color: #fcd2d2;
      .noti-cp-icon,
      .noti-cp-title {
        color: #f46a6a !important;
      }
    }
    &.noti-warning {
      color: #916c2e;
      background-color: #fcf0db;
      border-color: #fbe9c9;
      .noti-cp-icon,
      .noti-cp-title {
        color: #f1b44c !important;
      }
    }
    &.noti-info {
      color: #306391;
      background-color: #dcedfc;
      border-color: #cbe4fb;
      .noti-cp-icon,
      .noti-cp-title {
        color: #50a5f1 !important;
      }
    }
    .noti-cp-icon {
      flex: 0 1 auto;
      font-size: 32px;
      padding: 0 10px;
    }
    .noti-cp-close {
      flex: 0 1 auto;
      padding: 0 20px;
      font-size: 16px;
      opacity: 0.8;
      cursor: pointer;
      &:hover {
        opacity: 0.8;
      }
    }
    .noti-cp-content {
      padding: 10px;
      flex: auto;
      .noti-cp-title {
        letter-spacing: 1px;
        font-size: 16px;
        margin-bottom: 0.5rem;
        line-height: 1.2;
        font-weight: 600;
      }
      .noti-cp-text {
        p {
          margin: 0;
        }
      }
    }
  }
  .v-fade-left-enter-active,
  .v-fade-left-leave-active,
  .v-fade-left-move {
    transition: all 0.5s;
  }
  .v-fade-left-enter,
  .v-fade-left-leave-to {
    opacity: 0;
    transform: translateX(500px) scale(0.2);
  }
}
</style>
