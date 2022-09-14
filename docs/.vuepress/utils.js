import path from "path";
import fs from "fs";
import { fileURLToPath } from "url";
import sidebarMap from "./sidebarMap.js";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const inferSiderbars = () => {
  const sidebar = {};

  sidebarMap.forEach(({ title, dirname }) => {
    const dirpath = path.resolve(__dirname, "../" + dirname);
    const parent = `/${dirname}/`;
    const children = fs
      .readdirSync(dirpath)
      .filter((item) => item.endsWith(".md"))
      .sort((prev, next) => (next.includes("README.md") ? 1 : 0));

    sidebar[parent] = [
      {
        text: title,
        children,
        collapsible: false,
      },
    ];
  });

  return sidebar;
};

export default inferSiderbars;
