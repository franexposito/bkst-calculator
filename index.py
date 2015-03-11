#-*- coding: utf-8 -*-
import web
from web.contrib.template import render_mako
from pymongo import MongoClient
from bson import json_util
import json

web.config.debug = False
urls = (
  '/calculadora', 'calculadora',
  '/save', 'save',
  '/*', 'error'
)
#MongoDB
client = MongoClient('mongodb://localhost:27017/')
#Plantillas
plantillas = render_mako(
        directories=['templates'],
        input_encoding='utf-8',
        output_encoding='utf-8',
      )
app = web.application(urls, locals())
#Sesiones
ses = web.session.Session(app, web.session.DiskStore('sessions'))

class calculadora:
    def GET(self):
        logueado = True
        if 'usuario' not in ses:
            logueado = False

        return plantillas.calculadora(l = logueado)

class save:
    def POST(self):
        web.header('Content-Type', 'application/json')
        return json.dumps({'resp':true})

class error:
    def GET(self):
        return "Acceso denegado"

if __name__ == "__main__":
    app.run()
