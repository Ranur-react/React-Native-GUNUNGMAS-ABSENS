import * as React from "react";
import Svg, { Path } from "react-native-svg";
import User from './../../assets/icons/user';
import Enter from './../../assets/icons/enter';
import Mata from './../../assets/icons/show';
import Back from './../../assets/icons/back';
import Camera from './../../assets/icons/Camera';
import Calenders from './../../assets/icons/Calenders';
import Upload from './../../assets/icons/Upload';
import Exit from './../../assets/icons/exit';
import Refresh from './../../assets/icons/Refresh';
import RefresM from './../../assets/icons/Refres-MaterialIcon';
import Sakit from './../../assets/icons/Sakit';

let Svgicon=(prop)=>{
  let ikon=[];
      if(prop.name == 'Enter'){
        ikon.push(<Enter op={prop.opacity} key={0} Color={prop.color} />)
      }else if(prop.name == 'Mata'){
        ikon.push(<Mata op={prop.opacity} key={1} Color={prop.color} />)
      }else if(prop.name == 'User'){
        ikon.push(<User op={prop.opacity} key={2} Color={prop.color}  />)
      }else if(prop.name == 'Back'){
        ikon.push(<Back op={prop.opacity} key={3} Color={prop.color}  />)
      }else if(prop.name == 'Camera'){
        ikon.push(<Camera op={prop.opacity} key={4} Color={prop.color}  />)
      }else if(prop.name == 'Kalender'){
        ikon.push(<Calenders op={prop.opacity} key={5} Color={prop.color}  />)
      }else if(prop.name == 'Upload'){
        ikon.push(<Upload op={prop.opacity} key={6} Color={prop.color}  />)
      }else if(prop.name == 'Exit'){
        ikon.push(<Exit Color={prop.color} key={7} op={prop.opacity}  />)
      }else if(prop.name == 'Refresh'){
        ikon.push(<Refresh Color={prop.color} key={7} op={prop.opacity}  />)
      }else if(prop.name == 'Refresh-M'){
        ikon.push(<RefresM Color={prop.color} key={7} op={prop.opacity}  />)
      }else if(prop.name == 'Sakit'){
        ikon.push(<Sakit Color={prop.color} key={7} op={prop.opacity}  />)
      }
  return ikon;
}

  export default Svgicon;
