FROM node:18-alpine 

WORKDIR /app

COPY *.json ./
 
RUN npm install

EXPOSE 5173
 
CMD [ "npm", "run", "dev" ]
