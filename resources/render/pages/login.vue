<template>
  <div class="login-wrapper">
    <img src="~/static/images/logo.svg" alt="" class="logo" />
    <!-- <img src="~/static/images/shape-bg.svg" alt="" class="shape-bg"> -->
    <div class="login-box">
      <div class="login-imgBox">
        <img src="~/static/images/loign-bg.svg" alt="" class="loign-bg" />
      </div>
      <div class="info-body">
        <div class="login-heading">
          <p class="heading">تسجيل الدخول</p>
          <p class="sub-heaing">اهلا وسهلاً بك عزيز المستخدم</p>
        </div>
        <div class="qe-inputBox">
          <input type="email" placeholder="Email" class="eq-input" />
          <img src="" alt="">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  layout: 'hideBars',
}
</script>
<style lang="scss" scoped>
@import '~/assets/styles/colors';
@import '~/assets/styles/sizes.scss';

.login-wrapper {
  position: relative;
  width: 100%;
  height: 100vh;
  min-height: 100vh;
  background: $app-background;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  flex-direction: column;
  .logo {
    margin-bottom: 2em;
  }
  // .shape-bg
  // {
  //   position: absolute;;
  //   bottom: 0;
  //   left: 0;
  //   width: 100%;
  //   z-index: 1;
  // }

  .login-box {
    position: relative;
    max-width: 80%;
    max-height: 816px;
    border-radius: 20px;
    background: #f2eeff;
    box-sizing: border-box;
    display: flex;
    overflow: hidden;
    .login-imgBox {
      width: 70%;
      img {
        width: 100%;
        object-fit: cocever;
      }
    }

    .info-body {
      width: 30%;
      display: flex;
      justify-content: center;
      align-items: center;
      background: #fff;
      flex-direction: column;
      p {
        float: right;
      }

      .qe-inputBox
      {
        width: 100%;
        background: #fafafb;
        border-radius: 13px;
         border: solid 1px #eaeaea;

      }
      .login-heading {
        width: 100%;
        .heading {
          font-size: 43px;
          font-weight: 900;
          color: $text-primary-color;
        }
        .sub-heaing {
          font-size: 16px;
          color: $text-hover-color;
          font-weight: 300;
        }
      }
    }
  }
}
</style>