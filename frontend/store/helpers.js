import { mapState, mapActions } from "vuex";

export const layoutComputed = {
  ...mapState("modules/layout", {
    layoutType: state => state.layoutType,
    leftSidebarType: state => state.leftSidebarType,
    layoutWidth: state => state.layoutWidth,
    topbar: state => state.topbar,
    loader: state => state.loader
  })
};

export const layoutMethods = mapActions("modules/layout", [
  "changeLayoutType",
  "changeLayoutWidth",
  "changeLeftSidebarType",
  "changeTopbar",
  "changeLoaderValue"
]);

export const authFackMethods = mapActions("modules/authfack", [
  "login",
  "registeruser",
  "logout"
]);

export const notificationMethods = mapActions("modules/notification", [
  "success",
  "error",
  "clear"
]);
