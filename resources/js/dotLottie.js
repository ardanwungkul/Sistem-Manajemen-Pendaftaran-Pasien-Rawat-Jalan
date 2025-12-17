import { DotLottie } from "@lottiefiles/dotlottie-web";
document.addEventListener("DOMContentLoaded", () => {
    new DotLottie({
        autoplay: true,
        loop: true,
        canvas: document.getElementById("animationLogin"),
        src: "/assets/dotlottie/loginAnimation.lottie",
    });
});
