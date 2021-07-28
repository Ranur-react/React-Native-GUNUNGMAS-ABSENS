import * as React from "react";
import Svg, { Path,G,Defs,ClipPath } from "react-native-svg";

function Icon(props) {
  return (
    <Svg
      width={50}
      height={50}
      viewBox="0 0 50 50"
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
      {...props}
    >
      <G clipPath="url(#prefix__clip0)">
        <Path
          d="M47.436 8.333H2.564A2.572 2.572 0 000 10.897v28.206a2.572 2.572 0 002.564 2.564h44.872A2.572 2.572 0 0050 39.102V10.898a2.572 2.572 0 00-2.564-2.564zm-.962 1.923l-19.999 15c-.36.274-.912.445-1.475.443-.564.002-1.115-.169-1.475-.443l-19.999-15h42.948zM35.79 26.246l10.898 13.462c.01.013.024.023.035.036H3.276c.011-.013.025-.023.036-.036l10.897-13.462a.962.962 0 00-1.495-1.21L1.923 38.366V11.458l20.449 15.337c.768.572 1.704.824 2.628.827.923-.002 1.859-.254 2.628-.827l20.449-15.337v26.908l-10.791-13.33a.961.961 0 10-1.495 1.21z"
          fill="#fff"
        />
      </G>
      <Defs>
        <ClipPath id="prefix__clip0">
          <Path fill="#fff" d="M0 0h50v50H0z" />
        </ClipPath>
      </Defs>
    </Svg>
  )
}

  export default Icon;
