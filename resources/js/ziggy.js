const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"users.index":{"uri":"ac\/users","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"register":{"uri":"register","methods":["GET","HEAD"]},"logout":{"uri":"logout","methods":["GET","HEAD"]},"profile.update":{"uri":"profile\/edit","methods":["POST"]},"profile.auth":{"uri":"profile\/edit\/auth","methods":["POST"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
