import * as React from "react";
import Svg, { Path,G,Defs,ClipPath } from "react-native-svg";

function Camera(props) {
  return (
    <Svg
    width={60}
    height={60}
    viewBox="0 0 60 60"
    fill={props.Color}
    xmlns="http://www.w3.org/2000/svg"
  >
    <G clipPath="url(#prefix__clip0)" fill="#fff">
      <Path d="M58.004 13.745c-1.198-1.254-2.852-1.996-4.734-1.996h-9.468v-.114c0-1.426-.57-2.795-1.54-3.707a5.219 5.219 0 00-3.707-1.54h-17.11c-1.483 0-2.795.57-3.764 1.54a5.218 5.218 0 00-1.54 3.707v.114H6.73c-1.882 0-3.536.742-4.734 1.996C.798 14.943 0 16.654 0 18.48v28.403c0 1.882.741 3.536 1.996 4.734 1.198 1.198 2.909 1.996 4.734 1.996h46.54c1.882 0 3.536-.741 4.734-1.996C59.202 50.418 60 48.707 60 46.882V18.48c0-1.882-.741-3.536-1.996-4.734zm-.97 33.137h-.057c0 1.027-.4 1.94-1.083 2.624a3.661 3.661 0 01-2.624 1.083H6.73c-1.027 0-1.94-.399-2.624-1.083a3.661 3.661 0 01-1.083-2.624V18.48c0-1.026.399-1.94 1.083-2.623a3.662 3.662 0 012.624-1.084h11.008c.855 0 1.54-.684 1.54-1.54v-1.654c0-.627.228-1.198.627-1.597.4-.4.97-.627 1.597-.627h17.053c.627 0 1.198.228 1.597.627.4.4.627.97.627 1.597v1.654c0 .856.685 1.54 1.54 1.54h11.008c1.027 0 1.94.4 2.624 1.083a3.662 3.662 0 011.083 2.624v28.403z" />
      <Path d="M30 18.65a14.055 14.055 0 00-9.924 4.107 13.918 13.918 0 00-4.107 9.924c0 3.878 1.598 7.414 4.107 9.924A13.918 13.918 0 0030 46.71c3.878 0 7.414-1.597 9.924-4.106a13.918 13.918 0 004.106-9.924c0-3.879-1.597-7.415-4.106-9.924A14.055 14.055 0 0030 18.65zm7.757 21.844c-1.997 1.94-4.734 3.194-7.757 3.194-3.023 0-5.76-1.255-7.757-3.194a10.903 10.903 0 01-3.194-7.756c0-3.023 1.255-5.76 3.194-7.757A10.903 10.903 0 0130 21.787c3.023 0 5.76 1.255 7.757 3.194a10.903 10.903 0 013.194 7.757c.057 3.023-1.198 5.76-3.194 7.756zM50.304 24.183a2.795 2.795 0 100-5.59 2.795 2.795 0 000 5.59z" />
    </G>
    <Defs>
      <ClipPath id="prefix__clip0">
        <Path fill="#fff" d="M0 0h60v60H0z" />
      </ClipPath>
    </Defs>
  </Svg>
  )
}

  export default Camera;