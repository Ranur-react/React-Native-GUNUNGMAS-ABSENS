import * as React from "react";
import Svg, { Path } from "react-native-svg";

function SvgComponent(props) {
  return (
    <Svg viewBox="0 0 511.992 511.992" fill={props.Color}>
      <Path d="M510.096 249.937c-4.032-5.867-100.928-143.275-254.101-143.275-131.435 0-248.555 136.619-253.483 142.443-3.349 3.968-3.349 9.792 0 13.781C7.44 268.71 124.56 405.329 255.995 405.329S504.549 268.71 509.477 262.886c3.094-3.669 3.371-8.981.619-12.949zM255.995 383.996c-105.365 0-205.547-100.48-230.997-128 25.408-27.541 125.483-128 230.997-128 123.285 0 210.304 100.331 231.552 127.424-24.534 26.645-125.291 128.576-231.552 128.576z" />
      <Path d="M255.995 170.662c-47.061 0-85.333 38.272-85.333 85.333s38.272 85.333 85.333 85.333 85.333-38.272 85.333-85.333-38.272-85.333-85.333-85.333zm0 149.334c-35.285 0-64-28.715-64-64s28.715-64 64-64 64 28.715 64 64-28.715 64-64 64z" />
    </Svg>
  )
}

  export default SvgComponent;
