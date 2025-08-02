import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";
import path from "path";

export default defineConfig(({ mode }) => {
  return {
    root: "./src",
    base: mode === "production" ? "/wp-content/themes/sitebox-theme/" : "/",
    build: {
      outDir: "../assets",
      emptyOutDir: true,
      rollupOptions: {
        input: {
          main: path.resolve(__dirname, "./src/js/main.jsx"),
          styles: path.resolve(__dirname, "./src/scss/main.scss"),
        },
        output: {
          entryFileNames: "js/[name].js",
          assetFileNames: (chunkInfo) => {
            if (chunkInfo.name && chunkInfo.name.endsWith(".css")) {
              return "css/[name].css";
            }
            return "assets/[name].[ext]";
          },
        },
      },
    },
    plugins: [react()],
    server: {
      port: 5174,
      proxy: {
        "/": {
          target: "http://localhost:10009",
          changeOrigin: true,
          secure: false,
        },
      },
    },
  };
});
