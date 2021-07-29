const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"login":{"uri":"login","methods":["GET","HEAD"]},"hello":{"uri":"login","methods":["POST"]},"register":{"uri":"register","methods":["GET","HEAD"]},"logout":{"uri":"logout","methods":["GET","HEAD"]},"profile.update":{"uri":"profile\/edit","methods":["POST"]},"profile.auth":{"uri":"profile\/edit\/auth","methods":["POST"]},"challenge.index":{"uri":"challenge","methods":["GET","HEAD"]},"challenge.create":{"uri":"challenge\/create","methods":["GET","HEAD"]},"challenge.store":{"uri":"challenge","methods":["POST"]},"challenge.show":{"uri":"challenge\/{challenge}","methods":["GET","HEAD"]},"challenge.edit":{"uri":"challenge\/{challenge}\/edit","methods":["GET","HEAD"]},"challenge.update":{"uri":"challenge\/{challenge}","methods":["PUT","PATCH"]},"challenge.destroy":{"uri":"challenge\/{challenge}","methods":["DELETE"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
