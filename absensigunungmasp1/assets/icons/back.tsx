import * as React from "react";
import Svg, { Path } from "react-native-svg";

function Enter(props) {
  return (
    <Svg
    width={12}
    height={20}
    viewBox="0 0 12 20" fill={props.Color}>
    <Path
      d="M.572 8.579c.101-.101.212-.187.327-.26L8.651.566a1.938 1.938 0 012.74 2.74L4.714 9.983l6.71 6.71a1.937 1.937 0 11-2.74 2.74L.9 11.646a1.925 1.925 0 01-.891-1.664 1.926 1.926 0 01.564-1.403z"
      fill="#000"
    />
    </Svg>
  )
}

  export default Enter;
